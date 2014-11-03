<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Edit enderecoempresa record number {[$enderecoempresa->id]}</h1>
		Enderecoempresa related to:
		<ul>
			<li>Endereco: {[$endereco->cep]}</li>
			<li>
				Enderecobase: {[$endereco->enderecobase->cep_base]}
			</li>
			<li>
				Bairro: {[$endereco->enderecobase->bairro->nome]}
			</li>
			<li>
				Cidade: {[$endereco->enderecobase->bairro->cidade->nome]}
			</li>
			<li>
				Estado: {[$endereco->enderecobase->bairro->cidade->estado->nome]}
			</li>
		</ul>
		{[ Form::model($enderecoempresa, array('route' => array('estado.cidade.bairro.enderecobase.endereco.enderecoempresa.update', $estado_id,$cidade_id,$bairro_id,$enderecobase_id,$endereco_id,$id), 'method' => 'PUT')) ]}
		<div class="row">
			<div class="col-sm-2">
				empresa {[$enderecoempresa->empresa->nome]}
				<br>
				<input type="hidden" class='form-control' name="empresa_id" id="empresa_id" value="{[$enderecoempresa->empresa_id]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				tipo
				<br>
				<input type="text" class='form-control' name="tipo" id="tipo" value="{[$enderecoempresa->tipo]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				complemento
				<br>
				<input type="text" class='form-control' name="complemento" id="complemento" value="{[$enderecoempresa->complemento]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				observacao
				<br>
				<input type="text" class='form-control' name="observacao" id="observacao" value="{[$enderecoempresa->observacao]}">
			</div>
		</div>
		<br>
		<br>
		<input type="submit" value='SAVE CHANGES'>
		{[Form::close()]}
		<br>
		<a href="{[URL::to('estado/'.$estado_id.'/cidade/'.$cidade_id.'/bairro/'.$bairro_id.'/enderecobase/'.$enderecobase_id.'/endereco/'.$endereco_id.'/visibleenderecoempresa') ]}">Back to enderecoempresa index</a>
		<br>
		<br>
		<br>
	</div>
</body>	