<?php $fake= new fakeuser; ?>
<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Adding a new convenio for empresa {[ Empresa::find($fake->empresa())->nome ]}</h1>
		<div class="row">
			<div class="col-sm-4">
				{[Form::open(array('url'=>URL::to('convenio')  ) )]}
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
							limite_id
							<br>
							<input type="text" name="limite_id" id="limite_id" class='form-control'>
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
						</div>
					@endforeach
				</div>
			</div>
		</div>
		<br>
		<br>
		<a href="{[URL::to('convenio') ]}">Back to convenio index</a>
	</div>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</body>
<script>
	$(function(){
		$('#plano_id').change(function(e){
			e.preventDefault();
			var plano_id=$(this).val();
			$('.plano_desc').addClass('text-muted').removeClass('lead');
			$('#plano_'+plano_id).removeClass('text-muted').addClass('lead');
		});
	});
</script>