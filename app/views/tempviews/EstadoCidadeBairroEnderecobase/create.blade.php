<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>
			Add a new enderecobase
		</h1>
		Data for enderecobase located at
		<ul>
			<li>
				Bairro: {[$bairro->nome]}
			</li>
			<li>
				Cidade: {[$bairro->cidade->nome]}
			</li>
			<li>
				Estado: {[$bairro->cidade->estado->nome]}
			</li>
		</ul>
		{[Form::open(array('url'=>URL::to('estado/'.$estado_id.'/cidade/'.$cidade_id.'/bairro/'.$bairro_id.'/enderecobase')  )  )]}
		<div class="row">
			<div class="col-sm-2">
				cep_base
				<br>
				<input type="text" name="cep_base" id="cep_base" class='form-control'>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				logradouro
				<br>
				<input type="text" name="logradouro" id="logradouro" class='form-control'>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				regiao
				<br>
				<input type="text" name="regiao" id="regiao" class='form-control'>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				restricao_hr_inicio_base
				<br>
				<input type="text" name="restricao_hr_inicio_base" id="restricao_hr_inicio_base" class='form-control'>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				restricao_hr_fim_base
				<br>
				<input type="text" name="restricao_hr_fim_base" id="restricao_hr_fim_base" class='form-control'>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				numero_inicio
				<br>
				<input type="text" name="numero_inicio" id="numero_inicio" class='form-control'>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				numero_fim
				<br>
				<input type="text" name="numero_fim" id="numero_fim" class='form-control'>
			</div>
		</div>
		<hr>
		<br>
		<input type="submit" value='create'>
		{[Form::close()]}
		<br>
		<a href="{[URL::to('estado/'.$estado_id.'/cidade/'.$cidade_id.'/bairro/'.$bairro_id.'/visibleenderecobase') ]}">Back to enderecobase index</a>
		<br>
		<br>
		<br>
	</div>
</body>