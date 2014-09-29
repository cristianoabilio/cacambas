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
		
		1. Convenio_id {[$c_id]} (should be hidden)
		<input type='hidden' name='convenio_id' id='convenio_id' value='{[$c_id]}' /> 
		<br>


		2. Empresa: not required (should be removed from schema)
		<br>
		


		3. Mes referencia
		<select id='mes_referencia'  name='mes_referencia'  >
			<option></option>
			<?php 
			for ($i=0; $i <12 ; $i++) { 
				echo 
				'<option value="'.($i+1).'">mes '.($i+1).'</option>'
				;
			}
			?>
		</select>
		|| Semestre referencia 
		<select id='semestre_referencia'  name='semestre_referencia'  >
			<option></option>
			<option value='1'>semestre 1</option>
			<option value='2'>semestre 2</option>
		</select>
		|| Ano <input type="text" id='ano_referencia' name='ano_referencia'>
		<br><br>

		<div class="text-danger">
			<h3>This whole segment can be removed as it was set on the controller</h3>
			Data required for invoice due date autocalculation
			<br>
			Invoice day (dia_fatura): {[$convenio->dia_fatura]}
			<br>
			Plan start date (dt_inicio): {[$dt_inicio_date_format]}
			<br>
			First time invoice due date: {[$invoice_due_date]} 
			- no matter if plan lasts 1, 6 or 12 months - 
		</div>
		<br>
		Data vencimiento: {[$invoice_due_date]} (hidden input)
		<input type="hidden" name='data_vencimento' id='data_vencimento' value='{[$invoice_due_date]}'><br>
		data_pagamento<input type="text" id='data_pagamento'  name='data_pagamento' > <br>
		forma_pagamento <input type="text" name="forma_pagamento" id="forma_pagamento"><br>
		status_pagamento <input type="text" name="status_pagamento" id="status_pagamento"><br>
		Plano: {[$convenio->plano->nome]} ({[$convenio->plano->descricao]} ) <br>
		<br>
		Valor plano = total - disconto - disconto percentage 
		<br>
		total {[$convenio->plano->valor_total]} <br>
		disconto {[$plano_desconto]}  <br>
		disconto percentage {[$plano_percent_disconto]} <br>
		valor_plano {[$final_valor_plano]} (hidden input field)
		<input type="hidden" name="valor_plano" id="valor_plano" value='{[$final_valor_plano]}'><br>
		compras <br>
		<hr>
		<div class="row">
			<div class="col-sm-3">Produto compra </div>
			<div class="col-sm-3">valor </div>
			<div class="col-sm-3">Desconto </div>
			<div class="col-sm-3">date</div>
		</div>
		<?php  
		$sumofproductpurchase =0;
		?>
		@foreach($convenio->compras as $c)
			@if($c->ativado==null)
				<div class="row">
					<div class="col-sm-3 text-info"> {[$c->produto->nome]} </div>
					<div class="col-sm-3"> {[$c->produto->valor]}</div>
					<div class="col-sm-3"> {[$c->desconto_valor]}</div>
					<div class="col-sm-3">{[$c->data_compra]}</div>
				</div> 
				<?php $sumofproductpurchase+=$c->produto->valor; ?>
			@endif	
		@endforeach
		total product purchase <b>{[$sumofproductpurchase]}</b>
		<br> <br>
		valor_prod_compra {[$sumofproductpurchase]} 
		<input type="hidden" name="valor_prod_compra" id="valor_prod_compra" value='{[$sumofproductpurchase]} '><br>
		<hr>
		<div class="row">
			<div class="col-sm-3">Produto uso </div>
			<div class="col-sm-3">valor </div>
			<div class="col-sm-3">Desconto </div>
			<div class="col-sm-3">date</div>
		</div>
		<?php  
		$sumofproductusage =0;
		?>
		@foreach($convenio->compras as $c)
			@if($c->ativado==1)
				<div class="row">
					<div class="col-sm-3 text-info"> {[$c->produto->nome]} </div>
					<div class="col-sm-3"> {[$c->produto->valor]}</div>
					<div class="col-sm-3"> {[$c->desconto_valor]}</div>
					<div class="col-sm-3">{[$c->data_compra]}</div>
				</div> 
				<?php $sumofproductusage+=$c->produto->valor; ?>
			@endif	
		@endforeach
		total product usage <b>{[$sumofproductusage]}</b>
		<br>
		valor_prod_uso <b>{[$sumofproductusage]}</b>
		<input type="hidden" name="valor_prod_uso" id="valor_prod_uso" value='{[$sumofproductusage]}'><br>
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
$('#test_hide').click(function(e){
	e.preventDefault();
	$(this).hide('fast');
});



</script>