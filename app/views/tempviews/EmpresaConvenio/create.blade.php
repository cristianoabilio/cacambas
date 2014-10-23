<?php $fake= new fakeuser; ?>
<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Adding a new convenio for empresa {[ Empresa::find($empresa_id)->nome ]}</h1>
		<div class="row">
			<div class="col-sm-4">
				{[Form::open(array('url'=>URL::to('empresa/'.$empresa_id.'/convenio')  ) )]}
					<div class="row">
						<div class="col-sm-6">
							plano
							<br>
							<select name="plano_id" id="plano_id" class='form-control'>
								<option value=""></option>
								@foreach(Plano::all() as $p)
									<option value="{[$p->id]}">{[$p->nome]}</option>
								@endforeach
							</select>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-sm-6">
							dia_fatura
							<br>
							<input type="text" name="dia_fatura" id="dia_fatura" class='form-control'>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-sm-6">
							tipo_pagamento
							<br>
							<input type="text" name="tipo_pagamento" id="tipo_pagamento" class='form-control'>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-sm-6">
							dt_inicio
							<br>
							<input type="text" name="dt_inicio" id="dt_inicio" class='form-control'>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-sm-6">
							dt_fim
							<br>
							<input type="text" name="dt_fim" id="dt_fim" class='form-control'>
						</div>
					</div>
					<h3 class="text-muted">Limite</h3>
					<div class="text-info">
						Shown data as default plan values.
						Modify according to your expectations.
					</div>
					<br>
					<div class="row">
						<div class="col-sm-12">plano limite (choose between default or customized)</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<select name="plano_custom" id="plano_custom" class='form-control'>
								<option value=""></option>
								<option value="default">default</option>
								<option value="custom">customized</option>
							</select>
						</div>
					</div>
					<div id="plano_default_values">
						@foreach($limite_h as $l)
							<div class="row">
								<div class="col-sm-4">{[$l]}</div>
								<div id='default_plano{[$l]}' class="col-sm-6"></div>
							</div>
						@endforeach
					</div>
					<div id="plano_customizable_form">
						@foreach($limite_h as $l)
							<div class="row">
								<div class="col-sm-6">
									{[$l]}
									<br>
									<input type="text" name="{[$l]}" id="{[$l]}" class='form-control'>
								</div>
							</div>
						@endforeach
					</div>
						
					<br>
					<input type="submit" value='create'>
					<br>
				{[Form::close()  ]}
			</div>
			<div class="col-sm-6">
				<div class="row">
					<div class="col-sm-3 text-info">
						nome<br>
						descricao<br>
						valor_total<br>
						disponivel<br>
					</div>
					@foreach(Plano::all() as $p)
						<div class="col-sm-3 plano_desc" id='plano_{[$p->id]}'  > 
							{[$p->nome]}  <br>
							{[$p->descricao]}  <br>
							{[$p->valor_total]}  <br>
							{[$p->disponivel]}  <br>
							<div class="hide ">
								@foreach($limite_h as $l)
								<div id="standardlimite_{[$l.'_'.$p->id]}" class='limite{[$p->id]}'>{[$p->limite->$l]}</div>
								@endforeach
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</div>
		<br>
		<br>
		<a href="{[URL::to('empresa/'.$empresa_id.'/visibleconvenio') ]}">Back to convenio index</a>
		<br>
		<br>
		<br>
	</div>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</body>
<script>
	$(function(){
		//Hide tags with default limite data and customizable limite form
		$('#plano_default_values').hide();
		$('#plano_customizable_form').hide();

		//Toggle between default - customizable tags content 
		//depending on select list choosen option
		$('#plano_custom').on('change',function(e){
			//e.preventDefault();
			if ( $(this).val()=='default' ) {
				$('#plano_default_values').show('fast');
				$('#plano_customizable_form').hide('fast');
			}
			else if ( $(this).val()=='custom' ) {
				$('#plano_default_values').hide('fast');
				$('#plano_customizable_form').show('fast');
			}
			else {
				$('#plano_default_values').hide('fast');
				$('#plano_customizable_form').hide('fast');
			}

		});

		//change default and customizable tag data according to choosen plano
		$('#plano_id').change(function(e){
			
			var plano_id=$(this).val();

			//Mute all planos
			$('.plano_desc').addClass('text-muted').removeClass('lead');

			//Highlight choosen plano
			$('#plano_'+plano_id).removeClass('text-muted').addClass('lead');

			//Set limite data for default and customizable tagas
			//For each plano record, limite data would be picked up
			$('.limite'+plano_id).each(function(){

				//retrieving id on limite[plano] class
				var limitefeature=$(this).attr('id');

				//finding the limite_id value
				limitefeature=limitefeature.replace('standardlimite_','');
				limitefeature=limitefeature.replace('_'+plano_id,'');
				limitefeature=limitefeature.trim();

				//retrieving limite data on each limite[plano_id] class
				//and sending it to each #limite[each limit field]
				//on default and customizable tags
				var limitevalue=$(this).html();
				$('#'+limitefeature).val(limitevalue);
				$('#default_plano'+limitefeature).text(limitevalue);
			});
		});
	});
</script>