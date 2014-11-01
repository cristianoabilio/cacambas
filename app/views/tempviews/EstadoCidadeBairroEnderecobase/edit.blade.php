<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Edit enderecobase record number {[$enderecobase->id]}</h1>
		{[ Form::model($enderecobase, array('route' => array('enderecobase.update', $enderecobase->id), 'method' => 'PUT')) ]}
		<div class="row">
			<div class="col-sm-2">
				bairro_id 
				<br>
				<input type="text" class='form-control' name="bairro_id" id="bairro_id" value="{[$enderecobase->bairro_id]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				cidade_id
				<br>
				<input type="text" class='form-control' name="cidade_id" id="cidade_id" value="{[$enderecobase->cidade_id]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				estado_id
				<br>
				<input type="text" class='form-control' name="estado_id" id="estado_id" value="{[$enderecobase->estado_id]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				cep_base
				<br>
				<input type="text" class='form-control' name="cep_base" id="cep_base" value="{[$enderecobase->cep_base]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				logradouro
				<br>
				<input type="text" class='form-control' name="logradouro" id="logradouro" value="{[$enderecobase->logradouro]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				regiao
				<br>
				<input type="text" class='form-control' name="regiao" id="regiao" value="{[$enderecobase->regiao]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				restricao_hr_inicio
				<br>
				<input type="text" class='form-control' name="restricao_hr_inicio" id="restricao_hr_inicio" value="{[$enderecobase->restricao_hr_inicio]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				restricao_hr_fim
				<br>
				<input type="text" class='form-control' name="restricao_hr_fim" id="restricao_hr_fim" value="{[$enderecobase->restricao_hr_fim]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				numero_inicio
				<br>
				<input type="text" class='form-control' name="numero_inicio" id="numero_inicio" value="{[$enderecobase->numero_inicio]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				numero_fim
				<br>
				<input type="text" class='form-control' name="numero_fim" id="numero_fim" value="{[$enderecobase->numero_fim]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				dthr_cadastro
				<br>
				<input type="text" class='form-control' name="dthr_cadastro" id="dthr_cadastro" value="{[$enderecobase->dthr_cadastro]}">
			</div>
		</div>
		<br>
		<br>
		<input type="submit" value='SAVE CHANGES'>
		{[Form::close()]}
		<br>
		<a href="{[URL::to('visibleenderecobase')]}">Back to endereco</a>
		<br>
		<br>
		<br>
	</div>
</body>	