<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Edit resource {[$EmpresaClienteAnotacoes->id]}</h1>
		{[ Form::model($EmpresaClienteAnotacoes, array('route' => array('empresaclienteanotacoes.update', $id), 'method' => 'PUT')) ]}
		<div class="row">
			<div class="col-sm-2">
				empresa_id
				<br>
				<input type="text" class='form-control' name="empresa_id" id="empresa_id" value="{[$EmpresaClienteAnotacoes->empresa_id]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				cliente_id
				<br>
				<input type="text" class='form-control' name="cliente_id" id="cliente_id" value="{[$EmpresaClienteAnotacoes->cliente_id]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				anotacao
				<br>
				<input type="text" class='form-control' name="anotacao" id="anotacao" value="{[$EmpresaClienteAnotacoes->anotacao]}">
			</div>
		</div>
		<br>
		<br>
		<input type="submit" value='SAVE CHANGES'>
	{[Form::close()]}
	<br>
		{[ Form::model($EmpresaClienteAnotacoes, array('route' => array('empresaclienteanotacoes.destroy', $id), 'method' => 'DELETE')) ]}
	<input type="submit" value='DELETE'>
	{[Form::close()]}
	<a href="{[URL::to('visibleempresaclienteanotacoes')]}       ">Back to empresaClienteAnotacoes index</a>
	<br>
	<br>
	<br>
	</div>
</body>


