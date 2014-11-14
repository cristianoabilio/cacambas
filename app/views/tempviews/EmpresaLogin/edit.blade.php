<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Edit user (login) number {[$login->id]}</h1>
		{[ Form::model($login, array('route' => array('empresa.login.update', $empresa_id,$login->id), 'method' => 'PUT')) ]}
		<div class="row">
			<div class="col-sm-2">
				nome
				<br>
				<input type="text" class='form-control' name="nome" id="nome" value="{[$login->nome]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				email
				<br>
				<input type="text" class='form-control' name="email" id="email" value="{[$login->email]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				login {[$login->login]} (uneditable)
				<br>
				<input type="hidden" class='form-control' name="login" id="login" value="{[$login->login]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				senha
				<br>
				<input type="text" class='form-control' name="senha" id="senha" value="">
			</div>
		</div>
		<br>
		<br>
		<input type="submit" value='SAVE CHANGES'>
		{[Form::close()]}
		<br>
		{[ Form::model($login, array('route' => array('empresa.login.destroy', $empresa_id,$id), 'method' => 'DELETE')) ]}
		<input type='submit' value='delete'>
		{[Form::close()]}
	</div>
</body>
