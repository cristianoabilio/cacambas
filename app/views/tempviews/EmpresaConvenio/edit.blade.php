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
					</div>					<hr>
					limite setup {[$convenio->limite_id]}
					<div class="row">
						<div class="col-sm-3">Limite item</div>
						<div class="col-sm-3">Current</div>
						<div class="col-sm-3">New</div>
					</div>
					@foreach($limiteheader as $lh)
					<div class="row">
						<div class="col-sm-3">{[$lh]}</div>
						<div class="col-sm-3">{[$limite->$lh]} </div>
						<div class="col-sm-3">
							<input type="text" name="{[$lh]}" id="{[$lh]}" value='{[$limite->$lh]}' class='form-control'>
						</div>
					</div>
					@endforeach
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
		$('.plano_desc').hide();
		//
		$('#plano_id').change(function(){
			var plano_id=$(this).val();
			$('.plano_desc').hide();
			$('#plano_'+plano_id).show();
		});
	});
</script>