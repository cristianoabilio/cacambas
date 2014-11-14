<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Add new user (login record) to empresa {[$empresa_id]}</h1>
		{[Form::open(array('url'=>URL::to('empresa/'.$empresa_id.'/login') ) )]}
		<div class="row">
			<div class="col-sm-2">
				nome
				<br>
				<input type="text" class='form-control' name="nome" id="nome">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				email
				<br>
				<input type="text" class='form-control' name="email" id="email">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				login
				<br>
				<input type="text" class='form-control' name="login" id="login">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				senha
				<br>
				<input type="text" class='form-control' name="senha" id="senha">
			</div>
		</div>
		<br>
		<br>
		<input type="submit" value='create'>
		{[Form::close()]}
		<br>
		<a href="{[URL::to('empresa/'.$empresa_id.'/visiblelogin')]}">Go back to login index</a>
	</div>
</body>
