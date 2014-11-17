<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Edit funcionario number {[$funcionario->id]}</h1>
		{[ Form::model($funcionario, array('route' => array('empresa.funcionario.update', $empresa_id,$funcionario->id), 'method' => 'PUT')) ]}
		<div class="row">
			<div class="col-sm-2">
				username {[$funcionario->Login->login]}
				<br>
				<input type="hidden" class='form-control' name="login_id" id="login_id" value="{[$funcionario->login_id]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				nome
				<br>
				<input type="text" class='form-control' name="nome" id="nome" value="{[$funcionario->nome]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				funcao
				<br>
				<input type="text" class='form-control' name="funcao" id="funcao" value="{[$funcionario->funcao]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				telefone
				<br>
				<input type="text" class='form-control' name="telefone" id="telefone" value="{[$funcionario->telefone]}">
			</div>
		</div>
		<br>
		<input type="submit" value='SAVE CHANGES'>
		{[Form::close()]}
		<br>
		{[ Form::model($funcionario, array('route' => array('funcionario.destroy', $funcionario->id), 'method' => 'DELETE')) ]}
		<input type='submit' value='delete'>
		{[Form::close()]}
	</div>
</body>
