<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>
			Add new fatura for {[Empresa::find($empresa_id)->nome]}
		</h1>
		<hr>
		{[ Form::open(array('url' => 'convenio/'.$c_id.'/fatura')) ]}
		<div class="text-muted">
			1. Convenio_id {[$c_id]} hidden input
			<br>
			<input type='hidden' name='convenio_id' id='convenio_id' value='{[$c_id]}'/>
			2. Empresa: not required (should be removed from schema)
		</div>
		<hr>
		<div class="row">
			<div class="col-sm-1"></div>
			<div class="col-sm-2">
				type of invoice "fatura"
				<br>
				<select name="invoice_type" id="invoice_type" class='form-control'>
					<option value=""></option>
					<option value="plano">plano or service</option>
					<option value="produto_compra">produto</option>
				</select>
			</div>
		</div>
		<br>
		<div id="plano_service_subform">
			<h2>Plano purchase</h2>
			<div class="row">
				<div class="col-sm-1"></div>
				<div class="col-sm-2">
					convenio start date:
					<br>
					{[ $convenio->dt_inicio]}
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-1">
					
				</div>
				<div class="col-sm-2">
					Period plan<br>
					<select name="" id="select_period_plan" class='form-control'>
						<option value=""></option>
						<option value="Mes">Mes ( {[$period_due_date_month]}  )</option>
						<option value="Semestre">Semestre ( {[$period_due_date_semester]}  )</option>
						<option value="Ano">Ano ( {[$period_due_date_year]}  )</option>
					</select>
				</div>
				<div class="hide">
					<div id="due_data_for_Mes"> {[$period_due_date_month]} </div>
					<div id="due_data_for_Semestre"> {[$period_due_date_semester]} </div>
					<div id="due_data_for_Ano"> {[$period_due_date_year]} </div>
				</div>
				<div class="col-sm-2">
					<div id="mes_option" class='plano_options_on_fatura'>
						Mes referencia
						<br>
						<select id='mes_referencia' name='mes_referencia' class='form-control'>
							<option></option>
							<?php 
							for ($i=0; $i <12 ; $i++) { 
								echo 
								'<option value="'.($i+1).'">mes '.($i+1).'</option>'
								;
							}
							?>
						</select>
					</div>
					<div id="semestre_option" class='plano_options_on_fatura'>
						Semestre referencia 
						<br>
						<select id='semestre_referencia'  name='semestre_referencia'  class='form-control'>
							<option></option>
							<option value='1'>semestre 1</option>
							<option value='2'>semestre 2</option>
						</select>
					</div>
					<div id="ano_option" class='plano_options_on_fatura'>
						Ano 
						<br>
						<input type="text" id='ano_referencia' name='ano_referencia' class='form-control'>
					</div>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-1"></div>
				<div class="col-sm-2">
					data vencimiento
					<br>
					<spam id="data_vencimiento_label"></spam> 
					<input type="hidden" name='data_vencimento' id='data_vencimento' value=''>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-1"></div>
				<div class="col-sm-2">
					data_pagamento
					<input type="text" id='data_pagamento' name='data_pagamento' class='form-control'>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-1"></div>
				<div class="col-sm-2">
					forma_pagamento
					<input type="text" name="forma_pagamento" id="forma_pagamento" class='form-control'>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-1"></div>
				<div class="col-sm-2">
					status_pagamento
					<input type="text" name="status_pagamento" id="status_pagamento"  class='form-control'>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-sm-1">
					Plano:
				</div>
				<div class="col-sm-2">
					{[$convenio->plano->nome]} ({[$convenio->plano->descricao]} )
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2">VALOR PLANO</div>
				<div class="col-sm-2">DISCONTO %</div>
				<div class="col-sm-2">DISCONTO VALOR</div>
				<div class="col-sm-2">VALOR FINAL</div>
			</div>
			<div class="row">
				<div class="col-sm-2">{[$convenio->plano->valor_total]}</div>
				<div class="col-sm-2">{[$plano_percent_disconto]}</div>
				<div class="col-sm-2">
					{[$convenio->plano->valor_total*$plano_percent_disconto]}
				</div>
				<div class="col-sm-2">
					{[$convenio->plano->valor_total-$convenio->plano->valor_total*$plano_percent_disconto]}
				</div>
			</div>
			<input type="hidden" name="valor_plano" id="valor_plano" 
			value='{[$convenio->plano->valor_total-$convenio->plano->valor_total*$plano_percent_disconto]}'>
			
			<br>
			<hr>
			<div class="row">
				<div class="col-sm-2">Produto uso </div>
				<div class="col-sm-2">valor </div>
				<div class="col-sm-2">Desconto </div>
				<div class="col-sm-2">date</div>
			</div>
			<?php  
			$sumofproductusage =0;
			?>
			@foreach($convenio->compras as $c)
				@if($c->ativado==1)
					<div class="row">
						<div class="col-sm-2 text-info"> {[$c->produto->nome]} </div>
						<div class="col-sm-2"> {[$c->produto->valor]}</div>
						<div class="col-sm-2"> {[$c->desconto_valor]}</div>
						<div class="col-sm-2">{[$c->data_compra]}</div>
					</div> 
					<?php $sumofproductusage+=$c->produto->valor; ?>
				@endif	
			@endforeach
			total product usage <b>{[$sumofproductusage]}</b>
			<input type="hidden" name="valor_prod_uso" id="valor_prod_uso" value='{[$sumofproductusage]}'><br>
		</div>
		<div id="produto_compra_subform">
			<h2>Compras</h2>
			<div class="row">
				<div class="col-sm-2">Produto compra </div>
				<div class="col-sm-2">valor </div>
				<div class="col-sm-2">Desconto </div>
				<div class="col-sm-3">date</div>
			</div>
			<?php  
			$sumofproductpurchase =0;
			?>
			@foreach($convenio->compras as $c)
				@if($c->ativado==null)
					<div class="row">
						<div class="col-sm-2 text-info"> {[$c->produto->nome]} </div>
						<div class="col-sm-2"> {[$c->produto->valor]}</div>
						<div class="col-sm-2"> {[$c->desconto_valor]}</div>
						<div class="col-sm-3">{[$c->data_compra]}</div>
					</div> 
					<?php $sumofproductpurchase+=$c->produto->valor; ?>
				@endif	
			@endforeach
			total product purchase <b>{[$sumofproductpurchase]}</b>
			<input type="hidden" name="valor_prod_compra" id="valor_prod_compra" value='{[$sumofproductpurchase]} '>
		</div>
		<br>
		<br>
		<br>
			
		<br>
		valor_boleto <input type="text" name="valor_boleto" id="valor_bol eto"><br>
		<?php  
		$total_price=$final_valor_plano+$sumofproductusage+$sumofproductpurchase ;
		?>
		<h3>valor_total {[$total_price]}</h3>
		<input type="hidden" name="valor_total" id="valor_total" value='{[$total_price]}'><br>
		ajuste_tipo <input type="text" name="ajuste_tipo" id="ajuste_tipo"><br>
		ajuste_valor <input type="text" name="ajuste_valor" id="ajuste_valor"><br>
		ajuste_percentual <input type="text" name="ajuste_percentual" id="ajuste_percentual"><br>
		pagarme <input type="text" name="pagarme" id="pagarme"><br>
		<hr>
		<input type='submit' value='create'/>
		{[Form::close()]}
	</div>
</body>
<br>

<!-- 
TEMPORARY JQUERY METHODS FOR DAY/SEMESTER/YEAR INVOICE OPTIONS
DIA / SEMESTER / ANO
-->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<script type="text/javascript">
$(function(){
	$('.plano_options_on_fatura').hide();
	$('#plano_service_subform').hide();
	$('#produto_compra_subform').hide();

	$('#invoice_type').change(function(e){
		e.preventDefault();
		var i_t=$('#invoice_type').val();
		if (i_t=='plano') {
			$('#plano_service_subform').show('fast');
			$('#produto_compra_subform').hide('fast');
		}
		else if (i_t=='produto_compra') {
			$('#plano_service_subform').hide('fast');
			$('#produto_compra_subform').show('fast');
		}
		else {
			$('#plano_service_subform').hide();
			$('#produto_compra_subform').hide();
		}
	});
});



$('#select_period_plan').change(function(e){
	var period=$('#select_period_plan').val();
	$('.plano_options_on_fatura').hide('fast');
	$('#mes_referencia').val('');
	$('#semestre_referencia').val('');
	$('#ano_referencia').val('');
	var mes=$('#due_data_for_Mes').html();
	var sem=$('#due_data_for_Semestre').html();
	var ano=$('#due_data_for_Ano').html();
	if (period=='Mes') {
		$('#mes_option').show('fast');
		$('#data_vencimiento_label').html(mes);
		$('#data_vencimento').val(mes);
	}
	else if (period=='Semestre') {
		$('#semestre_option').show('fast');
		$('#data_vencimiento_label').html(sem);
		$('#data_vencimento').val(sem);
	}
	else if (period=='Ano') {
		$('#ano_option').show('fast');
		$('#data_vencimiento_label').html(ano);
		$('#data_vencimento').val(ano);
	}
	else {
		$('#data_vencimiento_label').html('');
		$('#data_vencimento').val('');
	}
	
});

</script>