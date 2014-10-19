<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Edit enderecoempresa record number {[$enderecoempresa->id]}</h1>
		{[ Form::model($enderecoempresa, array('route' => array('enderecoempresa.update', $enderecoempresa->id), 'method' => 'PUT')) ]}
		<div class="row">
			<div class="col-sm-2">
				empresa_id
				<br>
				<input type="text" class='form-control' name="empresa_id" id="empresa_id" value="{[$enderecoempresa->empresa_id]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				enderecobase_id
				<br>
				<input type="text" class='form-control' name="enderecobase_id" id="enderecobase_id" value="{[$enderecoempresa->enderecobase_id]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				endereco_id
				<br>
				<input type="text" class='form-control' name="endereco_id" id="endereco_id" value="{[$enderecoempresa->endereco_id]}">
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
		<div class="row">
			<div class="col-sm-2">
				status
				<br>
				<input type="text" class='form-control' name="status" id="status" value="{[$enderecoempresa->status]}">
			</div>
		</div>
		<br>
		<br>
		<br>
		<input type="submit" value='SAVE CHANGES'>
		{[Form::close()]}
		<br>
		<a href="{[URL::to('visibleenderecoempresa')]}">Back to enderecoempresa</a>
		<br>
		<br>
		<br>
	</div>
</body>	