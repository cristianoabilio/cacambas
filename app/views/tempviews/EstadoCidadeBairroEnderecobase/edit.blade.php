<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Edit enderecobase record number {[$enderecobase->id]}</h1>
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
		{[ Form::model($enderecobase, array('route' => array('estado.cidade.bairro.enderecobase.update', $estado_id,$cidade_id,$bairro_id,$id), 'method' => 'PUT')) ]}
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
		<input type="submit" value='SAVE CHANGES'>
		{[Form::close()]}
		<br>
		<a href="{[URL::to('estado/'.$estado_id.'/cidade/'.$cidade_id.'/bairro/'.$bairro_id.'/visibleenderecobase')]}">Back to enderecobase</a>
		<br>
		<br>
		<br>
	</div>
</body>	