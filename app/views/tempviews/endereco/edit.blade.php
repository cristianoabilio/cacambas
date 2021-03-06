<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Edit endereco record number {[$endereco->id]}</h1>
		{[ Form::model($endereco, array('route' => array('endereco.update', $endereco->id), 'method' => 'PUT')) ]}
		<div class="row">
			<div class="col-sm-2">
				numero
				<br>
				<input type="text" class='form-control' name="numero" id="numero" value="{[$endereco->numero]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				cep
				<br>
				<input type="text" class='form-control' name="cep" id="cep" value="{[$endereco->cep]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				latitude
				<br>
				<input type="text" class='form-control' name="latitude" id="latitude" value="{[$endereco->latitude]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				longitude
				<br>
				<input type="text" class='form-control' name="longitude" id="longitude" value="{[$endereco->longitude]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				restricao_hr_inicio
				<br>
				<input type="text" class='form-control' name="restricao_hr_inicio" id="restricao_hr_inicio" value="{[$endereco->restricao_hr_inicio]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				restricao_hr_fim
				<br>
				<input type="text" class='form-control' name="restricao_hr_fim" id="restricao_hr_fim" value="{[$endereco->restricao_hr_fim]}">
			</div>
		</div>
		<br>
		<br>
		<br>
		<input type="submit" value='SAVE CHANGES'>
		{[Form::close()]}
		<br>
		<a href="{[URL::to('visibleendereco')]}">Back to endereco</a>
		<br>
		<br>
		<br>
	</div>
</body>	