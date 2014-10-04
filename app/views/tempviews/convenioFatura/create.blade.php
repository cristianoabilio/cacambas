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
			<div class="col-sm-4">
				Invoice type ("fatura" type):
				Plano &amp; service products
			</div>
		</div>
		<br>
		<h2>Plano purchase</h2>
		<div class="row">
			<div class="col-sm-1"></div>
			<div class="col-sm-4">
				<small class="text-muted">
					convenio start date: 
					{[ $convenio->dt_inicio]}
				</small>
				<br>
				period start date
				
				{[$starting_period_date]}
				<input name='plan_period_start_date' 
				id='plan_period_start_date' type="hidden"
				class='form-control'
				value='{[$starting_period_date]}'
				>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-1">
				
			</div>
			<div class="col-sm-2">
				<!-- 
					PERIOD PLAN: Depending on choosing mes | semester | ano
					the due date (data vencimento) and the end period
					date will be automaticly set via jquery function
				 -->
				Period plan<br>
				<select name="" id="select_period_plan" class='form-control'>
					<option value=""></option>
					<option value="Mes">Mes </option>
					<option value="Semestre">Semestre</option>
					<option value="Ano">Ano </option>
				</select>
			</div>
			<div class="hide">
				<div id="due_data_for_Mes"> {[$period_due_date_month]} </div>
				<div id="due_data_for_Semestre"> {[$period_due_date_semester]} </div>
				<div id="due_data_for_Ano"> {[$period_due_date_year]} </div>
			</div>
			<div class="col-sm-3">
				period end date 
				<spam id="shown_end_date"></spam>
				<input name='plan_period_end_date' 
				id='plan_period_end_date' type="hidden"
				class='form-control'>
			</div>
			<div class="col-sm-3">
				invoice due date 
				<spam id="data_vencimiento_label">{[$invoice_due_date]}</spam> 
				<input type="hidden" name='data_vencimento' id='data_vencimento' value='{[$invoice_due_date]}'>
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
				{[$convenio->plano->nome]}
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
		<?php  
		$sumofproductusage 			=0;
		$sumofproductusage_mes 		=0;
		$sumofproductusage_semestre =0;
		$sumofproductusage_ano 		=0;

		//set number of days for one month invoice
		$rangeofdays_mes=
		strtotime($period_due_date_month)
		-strtotime($starting_period_date);
		$rangeofdays_mes=$rangeofdays_mes/(60*60*24);

		//set number of days for one semester invoice
		$rangeofdays_semestre=
		strtotime($period_due_date_semester)
		-strtotime($starting_period_date);
		$rangeofdays_semestre=$rangeofdays_semestre/(60*60*24);

		//set number of days for one year invoice
		$rangeofdays_ano=
		strtotime($period_due_date_year)
		-strtotime($starting_period_date);
		$rangeofdays_ano=$rangeofdays_ano/(60*60*24);
		?>
		<table class="table">
			<tr>
				<th>Service</th>
				<th>monthly value</th>
				<th>discount</th>
				<th>After discount</th>
				<th>date range</th>
				<th>billed days</th>
				<th>billed amount</th>
			</tr>
			@foreach($convenio->compras as $c)
				@if($c->ativado==1&&$c->produto->servico==1)
					<?php  
					$active_service_mes=false;
					$active_service_semestre=false;
					$active_service_ano=false;
					// startdate of service
					//conditions for products as true
					//for current invoice
					//1. data_ativacao < $ending_period_date
					//2. data_desativacao > $starting_period_date
					//3. If data_ativacao < $starting_period_date
					//   invoice will count only from starting date
					//4. If data_desativacao =null or > 
					//    $ending_period_date invoice will go until
					//    $ending_period_date
					if (strtotime($c->data_desativacao)>strtotime($starting_period_date)
						||$c->data_desativacao==null) 
					{
						if ($c->data_ativacao<$period_due_date_month) {
							$active_service_mes=true;
							$numberofmonths=1;
						}
						else if ($c->data_ativacao<$period_due_date_semester) {
							$active_service_semestre=true;
							$numberofmonths=6;
						}
						else if ($c->data_ativacao<$period_due_date_year) {
							$active_service_ano=true;
							$numberofmonths=12;
						}
					}
					/**
					* PERIOD INTERVAL ADJUSTMENTS
					* Formulas that check number of days inside a billing period.
					* 
					* For instance, as each month contains different number of days 
					* [28,29,30,31], intervals must be calculated base on date differences
					* instead of just multiplyinig number of months by 30 days.
					*/
					//
					//Month interval setup
					$month_interval=strtotime($period_due_date_month)-strtotime($starting_period_date);
					$month_interval=floor($month_interval/(60*60*24) );
					//
					//Semester interval setup
					$semester_interval=strtotime($period_due_date_semester)-strtotime($starting_period_date);
					$semester_interval=floor($semester_interval/(60*60*24) );
					//
					//Year interval setup
					$ano_interval
					=strtotime($period_due_date_year)-strtotime($starting_period_date);
					$ano_interval=floor($ano_interval/(60*60*24) );
					//
					//Discount adjustment
					$day_m=($c->produto->valor -($c->desconto_percentual*$c->produto->valor/100))/$month_interval;
					$day_s=(($c->produto->valor -($c->desconto_percentual*$c->produto->valor/100) )*6)/$semester_interval;
					$day_y=(($c->produto->valor -($c->desconto_percentual*$c->produto->valor/100) )*12)/$ano_interval;
					//
					//
					?>
					@if($active_service_mes==true ||$active_service_semestre==true  ||$active_service_ano==true)
					<tr class='data_service'
					mes='{[$active_service_mes]}' 
					semestre='{[$active_service_semestre]}'  
					ano='{[$active_service_ano]}' >
						<td class="text-info">
							{[$c->produto->nome]} 
						</td>
						<td>{[$c->produto->valor*1]}</td>
						<td>
							{[$c->desconto_percentual*$c->produto->valor/100]}
							<spam class="text-muted">
								( {[$c->desconto_percentual*1]} % )
							</spam>
						</td>
						<td>
							{[$c->produto->valor -($c->desconto_percentual*$c->produto->valor/100)]}
						</td>
						
						<?php
						/**
						* STARTING DATE SETUP FOR SERVICES
						* The first day of a service is not necessarily the first fatura
						* date, as service might be activated after the plan activation date.
						* So, service start date should be set according to relationships
						* between the invoice start date and the service activation date.
						*/
						$starting_period_date_timeformat=strtotime($starting_period_date);
						$activatedate_timeformat=strtotime($c->data_ativacao);
						if ( $starting_period_date_timeformat > $activatedate_timeformat ) {
							$first_day=$starting_period_date;
						}
						else {
							$first_day=$c->data_ativacao;
						}
						; 
						$desactivacao_timeformat=strtotime($c->data_desativacao);
						$last_day_month_dateformat=strtotime($period_due_date_month);
						if ($desactivacao_timeformat>$last_day_month_dateformat
							||
							$c->data_desativacao==null
							) {
							$lastday_m=$period_due_date_month;
						}
						else {
							$lastday_m=$c->data_desativacao;
						}
						$last_day_semester_dateformat=strtotime($period_due_date_semester);
						if ($desactivacao_timeformat>$last_day_semester_dateformat
							||
							$c->data_desativacao==null
							) {
							$lastday_s=$period_due_date_semester;
						}
						else {
							$lastday_s=$c->data_desativacao;
						}
						$last_day_year_dateformat=strtotime($period_due_date_year);
						if ($desactivacao_timeformat>$last_day_year_dateformat
							||
							$c->data_desativacao==null
							) {
							$lastday_y=$period_due_date_year;
						}
						else {
							$lastday_y=$c->data_desativacao;
						}
						//diff
						$month_diff=(strtotime($lastday_m)-strtotime($first_day))/(60*60*24);
						$semester_diff=(strtotime($lastday_s)-strtotime($first_day))/(60*60*24);
						$year_diff=(strtotime($lastday_y)-strtotime($first_day))/(60*60*24);
						$definitive_service_price_m=$month_diff*$day_m;
						$definitive_service_price_s=$semester_diff*$day_s;
						$definitive_service_price_y=$year_diff*$day_y;
						?>
						<td> 
							<spam class='days_on_month'>
								{[date('Y-m-d',strtotime($first_day) )]} to {[$lastday_m]}
							</spam>
							<spam  class='days_on_semester'>
								{[date('Y-m-d',strtotime($first_day) )]} to {[$lastday_s]}
							</spam>
							<spam class='days_on_year'>
								{[date('Y-m-d',strtotime($first_day) )]} to {[$lastday_y]}
							</spam>
						</td>
						<td>
							<spam class='days_on_month'>
								{[$month_diff]} <spam class="text-info"> / {[$month_interval]} </spam>
							</spam>
							<spam  class='days_on_semester'>
								{[$semester_diff]} <spam class="text-info"> / {[$semester_interval]} </spam>
							</spam>
							<spam class='days_on_year'>
								{[$year_diff]} <spam class="text-info"> / {[$ano_interval]} </spam>
							</spam>
						</td>
						<td>
							<spam class='days_on_month'>
								{[$definitive_service_price_m]}
							</spam>
							<spam  class='days_on_semester'>
								{[$definitive_service_price_s]}
							</spam>
							<spam class='days_on_year'>
								{[$definitive_service_price_y]}
							</spam>
						</td>
						
					</tr>
						<?php 
						if (strtotime($c->data_desativacao)>strtotime($starting_period_date)
							||$c->data_desativacao==null) 
						{
							//
						}
						$sumofproductusage+=$c->produto->valor; 
						$valueproduct_usage_month;
						if ($definitive_service_price_m>0) {
							# code...
						}
						?>
					@endif
				@endif
						
			@endforeach
		</table>
		<?php 
		$final_productusage_value=
		$sumofproductusage
		;
		?>
		total product usage value for period
		<div id="total_service_mes_period">{[$sumofproductusage_mes ]}</div>
		<div id="total_service_semestre_period">{[($sumofproductusage_mes+$sumofproductusage_semestre) ]}</div>
		<div id="total_service_ano_period">{[$final_productusage_value]}</div>
		<br>
		
		<input type="hidden" name="valor_prod_uso" 
		id="valor_prod_uso" value=''><br>
		valor total for plano and product usage 
		<div class="hide">
			<?php  
			$plano_and_discount=$convenio->plano->valor_total-$convenio->plano->valor_total*$plano_percent_disconto;?>
			<div id="total_plano_and_product_usage_mes">{[$plano_and_discount+$sumofproductusage_mes  ]}</div>
			<div id="total_plano_and_product_usage_semestre">{[$plano_and_discount+($sumofproductusage_mes+$sumofproductusage_semestre) ]}</div>
			<div id="total_plano_and_product_usage_ano">{[$plano_and_discount+$final_productusage_value]}</div>
		</div>
		<spam id="total_plano_and_product_usage"></spam>
		<div class="row">
			<div class="col-sm-1"></div>
			<div class="col-sm-2">
				valor_boleto
				<input type="text" name="valor_boleto" id="valor_boleto" class='form-control'>
				<br>
			</div>
		</div>
		 <br>
		 <div class="row">
		 	<div class="col-sm-1"></div>
		 	<div class="col-sm-2">
		 		<h3>valor total <spam id="valor_total_header"></spam>  </h3>
		 		<input type="hidden" name="valor_total" id="valor_total" value=''>
		 	</div>
		 </div>
		 <div class="row">
		 	<div class="col-sm-1"></div>
		 	<div class="col-sm-2">
		 		ajuste tipo
		 		<br>
		 		 <input type="text" name="ajuste_tipo" id="ajuste_tipo" class='form-control'>
		 	</div>
		 </div>
		 <div class="row">
		 	<div class="col-sm-1"></div>
		 	<div class="col-sm-2">
		 		ajuste_valor
		 		<br>
		 		 <input type="text" name="ajuste_valor" id="ajuste_valor" class='form-control'>
		 	</div>
		 </div>
		 <div class="row">
		 	<div class="col-sm-1"></div>
		 	<div class="col-sm-2">
		 		ajuste_percentual
		 		<br>
		 		<input type="text" name="ajuste_percentual" id="ajuste_percentual" class='form-control'>
		 	</div>
		 </div>
		 <div class="row">
		 	<div class="col-sm-1"></div>
		 	<div class="col-sm-2">
		 		pagarme
		 		<br>
		 		<input type="text" name="pagarme" id="pagarme" class='form-control'>
		 	</div>
		 </div>
		 <br>
		 <div class="row">
		 	<div class="col-sm-1"></div>
		 	<div class="col-sm-2">
		 		<input type='submit' class='btn btn-primary' value='create'/>
		 	</div>
		 </div>
		<hr>
		
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
	//$('#plano_service_subform').hide();
	$('#produto_compra_subform').hide();

	$('#invoice_type').change(function(e){
		e.preventDefault();
		var i_t=$('#invoice_type').val();
	});
	$('.plano_options_on_fatura').hide('fast');
	$('.data_service').hide();
	$('#total_service_mes_period').hide();
	$('#total_service_semestre_period').hide();
	$('#total_service_ano_period').hide();
	$('.days_on_month').hide();
	$('.days_on_semester').hide();
	$('.days_on_year').hide();
});



$('#select_period_plan').change(function(e){
	var period=$('#select_period_plan').val();
	
	$('#mes_referencia').val('');
	$('#semestre_referencia').val('');
	$('#ano_referencia').val('');
	var mes=$('#due_data_for_Mes').html();
	var sem=$('#due_data_for_Semestre').html();
	var ano=$('#due_data_for_Ano').html();

	//choosen period = mes
	if (period=='Mes') {
		$('#mes_option').show('fast');
		$('#shown_end_date').html(mes);
		$('#data_vencimento').val(mes);
		$('#plan_period_end_date').val(mes);
		$('.data_service').hide();
		$('.data_service').each(function(){
			if ($(this).attr('mes') == 1) {
				$(this).show();
			}
			else {
				$(this).hide();
			}
		});
		$('#total_service_mes_period').show();
		$('#total_service_semestre_period').hide();
		$('#total_service_ano_period').hide();
		$('#valor_prod_uso').val( $('#total_service_mes_period').html() );
		$('#total_plano_and_product_usage').html( $('#total_plano_and_product_usage_mes').html() );
		$('#valor_total').val( $('#total_plano_and_product_usage_mes').html() );
		$('.days_on_month').show();
		$('.days_on_semester').hide();
		$('.days_on_year').hide();
	}
	//choosen period = Semestre
	else if (period=='Semestre') {
		$('#semestre_option').show('fast');
		$('#shown_end_date').html(sem);
		$('#data_vencimento').val(sem);
		$('#plan_period_end_date').val(sem);
		$('.data_service').hide();
		$('.data_service').each(function(){
			if ($(this).attr('mes') == 1
				||$(this).attr('semestre') == 1) {
				$(this).show();
			}
			else {
				$(this).hide();
			}
		});
		$('#total_service_mes_period').hide();
		$('#total_service_semestre_period').show();
		$('#total_service_ano_period').hide();
		$('#valor_prod_uso').val( $('#total_service_semestre_period').html() );
		$('#total_plano_and_product_usage').html( $('#total_plano_and_product_usage_semestre').html() );
		$('#valor_total').val( $('#total_plano_and_product_usage_semestre').html() );
		$('.days_on_month').hide();
		$('.days_on_semester').show();
		$('.days_on_year').hide();
	}
	//choosen period = Ano
	else if (period=='Ano') {
		$('#ano_option').show('fast');
		$('#shown_end_date').html(ano);
		$('#data_vencimento').val(ano);
		$('#plan_period_end_date').val(ano);
		$('.data_service').show();
		$('#total_service_mes_period').hide();
		$('#total_service_semestre_period').hide();
		$('#total_service_ano_period').show();
		$('#valor_prod_uso').val( $('#total_service_ano_period').html() );
		$('#total_plano_and_product_usage').html( $('#total_plano_and_product_usage_ano').html() );
		$('#valor_total').val( $('#total_plano_and_product_usage_ano').html() );
		$('.days_on_month').hide();
		$('.days_on_semester').hide();
		$('.days_on_year').show();
	}
	else {
		$('#shown_end_date').html('');
		$('#data_vencimento').val('');
		$('#plan_period_end_date').val('');
		$('.data_service').hide();
		$('#total_service_mes_period').hide();
		$('#total_service_semestre_period').hide();
		$('#total_service_ano_period').hide();
		$('#valor_prod_uso').val('');
		$('#total_plano_and_product_usage').html( $('#').html('') );
		$('#valor_total').val('');
		$('.days_on_month').hide();
		$('.days_on_semester').hide();
		$('.days_on_year').hide();
	}
	
});

</script>