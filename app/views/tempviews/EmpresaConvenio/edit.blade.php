<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>	
<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h1>
					Edit convenio number {[$id]} 
					<small class="muted">for empresa {[$convenio->empresa->nome]}</small>
				</h1>
			</div>
		</div>
		<div class="row">
			<!-- Form section -->
			<div class="col-sm-6">
				{[ Form::model($convenio, array('route' => array('empresa.convenio.update', $empresa_id,$id), 'method' => 'PUT')) ]}
					<div class="row">
						<div class="col-sm-4">
							Plano ({[$convenio->plano->nome]})
							<br>
							<select name="plano_id" id="plano_id" class='form-control'>
								<option value=""></option>
								@foreach(Plano::all() as $p)
								<?php 
								$selected;
								if ($p->id==$convenio->plano_id) {
									$selected='selected';
								}
								else {
									$selected='';
								}
								 ?>
								<option value="{[$p->id]}" {[ $selected ]}>{[$p->nome]}</option>
								@endforeach
							</select>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-sm-4">
							total_nfse
							<br>
							<input type="text" name="total_nfse" id="total_nfse" value="{[$convenio->total_nfse]}" class='form-control'>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-sm-4">
							dia_fatura
							<br>
							<input type="text" name="dia_fatura" id="dia_fatura" value="{[$convenio->dia_fatura]}" class='form-control'>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-sm-4">
							tipo_pagamento
							<br>
							<input type="text" name="tipo_pagamento" id="tipo_pagamento" value="{[$convenio->tipo_pagamento]}" class='form-control'>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-sm-4">
							dt_inicio
							<br>
							<input type="text" name="dt_inicio" id="dt_inicio" value="{[$convenio->dt_inicio]}" class='form-control'>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-sm-4">
							dt_fim
							<br>
							<input type="text" name="dt_fim" id="dt_fim" value="{[$convenio->dt_fim]}" class='form-control'>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-sm-12">
							<h3>
							Limite options 
							<?php  
							if ($convenio->limite_id==''||$convenio->limite_id==null) {
								$current_limite_source='default';
							} else {
								$current_limite_source='customized';
							}
							?>
							(currently 
							<spam id="current_limite" class="text-info">{[$current_limite_source]}</spam>)
							</h3>
							<input type="hidden" id="plano_custom" name='plano_custom' value='{[$current_limite_source]}'>
							<br>
							Choose between default or customized plano limite
							<br>
							<a href="" id='set_limite_as_default'>Set to default limite values</a>
							|
							<a href="" id='set_limite_as_customized'>customize limite values</a>
						</div>
					</div>
					<div id="default_limite_section">
						<h3>Default limite values</h3>
						<div id="default_limite_id" class="hide">{[$convenio->plano->limite->id]}</div>
						@foreach(Plano::all() as $p)
						<div id="plano_info{[$p->id]}" class='plano_info'>
							@foreach($limite_h as $lh)
							<div class="row">
								<div class="col-sm-4">{[$lh]}</div>
								<div class="col-sm-2">{[$p->limite->$lh]}</div>
							</div>
							@endforeach
						</div>
							
						@endforeach
					</div>
					<div id="customized_limite_section">
						<h3>customizable limite values</h3>
						limite setup {[$convenio->limite_id]}
						<div class="row">
							<div class="col-sm-3">Limite item</div>
							<div class="col-sm-3">Current</div>
							<div class="col-sm-3">New</div>
						</div>
						@foreach($limite_h as $lh)
						<div class="row">
							<div class="col-sm-3">{[$lh]}</div>
							<div class="col-sm-3">{[$limite->$lh]} </div>
							<div class="col-sm-3">
								<input type="text" name="{[$lh]}" id="{[$lh]}" value='{[$limite->$lh]}' class='form-control'>
							</div>
						</div>
						@endforeach
					</div>
					<hr>
					<br>
					<input type="submit" value='SAVE CHANGES'>
				{[Form::close()]}
			</div>

			<!-- Plan "plano" description section -->
			<div class="col-sm-6">
				<div class="row">
					<div class="col-sm-3">Plano data</div>
					<div class="col-sm-3">Current</div>
					<div class="col-sm-3">New</div>
				</div>
				<div class="row">
					<div class="col-sm-3 text-info">
						nome<br>
						descricao<br>
						valor_total<br>
						disponivel<br>
					</div>
					<div class="col-sm-3">
						{[$convenio->plano->nome]} <br>
						{[$convenio->plano->descricao]} <br>
						{[$convenio->plano->valor_total]}<br>
						{[$convenio->plano->disponivel]} <br>
					</div>
					<div class="col-sm-3">
						@foreach(Plano::all() as $p)
							<div class="plano_desc" id="plano_{[$p->id]}">
								{[$p->nome]}  <br>
								{[$p->descricao]}  <br>
								{[$p->valor_total]}  <br>
								{[$p->disponivel]}  <br>
								<div>
									@foreach($limite_h as $l)
										<div id="standardlimite_{[$l.'_'.$p->id]}" class='limite{[$p->id]}'>{[$p->limite->$l]}</div>
									@endforeach
								</div>
							</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
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
		//detecting if current limite comes from default
		//plano limite or customized limite
		var current_limite=$('#current_limite').html().trim();
		if (current_limite=='default') {
			$('#customized_limite_section').hide();
		} else {
			$('#default_limite_section').hide();
		}

		//Allowing user to toggle between default or
		//customized limite values
		$('#set_limite_as_default').click(function(e){
			e.preventDefault();
			$('#customized_limite_section').hide('fast');
			$('#default_limite_section').show('fast');
			$('#plano_custom').val('default');
		});

		$('#set_limite_as_customized').click(function(e){
			e.preventDefault();
			$('#default_limite_section').hide('fast');
			$('#customized_limite_section').show('fast');
			$('#plano_custom').val('customized');
		});

		//hide all custom limite except current plano
		$('.plano_info').hide();//
		$('#plano_info'+$('#default_limite_id').html() ).show();
		
		$('.plano_desc').hide();
		//
		$('#plano_id').change(function(){
			var plano_id=$(this).val();

			//hide all planos
			$('.plano_desc').hide();

			//display only selected plano
			$('#plano_'+plano_id).show();

			//hide all planos on "default" tag
			$('.plano_info').hide();

			//display only selected plano on "default" tag
			$('#plano_info'+plano_id).show();

			//Set limite data for default and customizable tags
			//For each plano record, limite data would be picked up
			$('.limite'+plano_id).each(function(){
				//
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
			});
		});
	});
</script>