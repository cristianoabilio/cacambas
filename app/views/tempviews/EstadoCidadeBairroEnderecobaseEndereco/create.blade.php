<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1> Add a new endereco </h1>
		New data for endereco located at
		<ul>
			<li>
				Enderecobase: {[$enderecobase->cep_base]}
			</li>
			<li>
				Bairro: {[$enderecobase->bairro->nome]}
			</li>
			<li>
				Cidade: {[$enderecobase->bairro->cidade->nome]}
			</li>
			<li>
				Estado: {[$enderecobase->bairro->cidade->estado->nome]}
			</li>
		</ul>
		{[Form::open(array('url'=>URL::to('estado/'.$estado_id.'/cidade/'.$cidade_id.'/bairro/'.$bairro_id.'/enderecobase/'.$endebase_id.'/endereco')  )  )]}
		
		<h3 class="muted">Endereco</h3>
		<div class="row">
			<div class="col-sm-2">
				numero
				<br>
				<input type="text" name="numero" id="numero" class='form-control'>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				cep
				<br>
				<input type="text" name="cep" id="cep" class='form-control'>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				latitude
				<br>
				<input type="text" name="latitude" id="latitude" class='form-control'>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				longitude
				<br>
				<input type="text" name="longitude" id="longitude" class='form-control'>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-2">
				restricao_hr_inicio
				<br>
				<input type="text" name="restricao_hr_inicio" id="restricao_hr_inicio" class='form-control'>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				restricao_hr_fim
				<br>
				<input type="text" name="restricao_hr_fim" id="restricao_hr_fim" class='form-control'>
			</div>
		</div>
		<br>
		<input type="submit" value='create'>
		{[Form::close()]}
		<br>
		<a href="{[  URL::to('estado/'.$estado_id.'/cidade/'.$cidade_id.'/bairro/'.$bairro_id.'/enderecobase/'.$endebase_id.'/visibleendereco')  ]}">Back to endereco index</a>
		<br>
		<br>
		<br>
	</div>
</body>