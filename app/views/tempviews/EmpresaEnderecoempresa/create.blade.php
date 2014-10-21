<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>
			Add a new enderecoempresa
		</h1>
		{[Form::open(array('url'=>URL::to('empresa/'.$id.'/enderecoempresa')  )  )]}
		<h3 class="muted">Endereco base</h3>
		<div class="row">
			<div class="col-sm-2">
				bairro_id
				<br>
				<input type="text" name="bairro_id" id="bairro_id" class='form-control'>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				cidade_id
				<br>
				<input type="text" name="cidade_id" id="cidade_id" class='form-control'>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				estado_id
				<br>
				<input type="text" name="estado_id" id="estado_id" class='form-control'>
			</div>
		</div>
		<br>
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
		<h3 class="muted">Endereco</h3>
		<div class="row">
			<div class="col-sm-2">
				numero
				<br>
				<input type="text" name="numero" id="numero" class='form-control'>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-2">
				cep
				<br>
				<input type="text" name="cep" id="cep" class='form-control'>
			</div>
		</div>
		<br>
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
		<hr>
		<h3 class="muted">Enderecoempresa</h3>
		<div class="row">
			<div class="col-sm-2">
				tipo
				<br>
				<input type="text" name="tipo" id="tipo" class='form-control'>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				complemento
				<br>
				<input type="text" name="complemento" id="complemento" class='form-control'>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				observacao
				<br>
				<input type="text" name="observacao" id="observacao" class='form-control'>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				status
				<br>
				<input type="text" name="status" id="status" class='form-control'>
			</div>
		</div>
		<br>
		<input type="submit" value='create'>
		{[Form::close()]}
		<br>
		<a href="{[URL::to('empresa/'.$id.'/visibleenderecoempresa') ]}">Back to enderecoempresa index</a>
		<br>
		<br>
		<br>
	</div>
</body>