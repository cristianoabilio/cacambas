<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Add a new "cidade" for estado {[Estado::find($estado_id)->nome]}</h1>
		{[Form::open(array('url'=>URL::to('estado/'.$estado_id.'/cidade') ))]}
		<div class="row">
			<div class="col-sm-2">
				nome
				<br>
				<input type="text" class='form-control' name="nome" id="nome"><br>
			</div>
		</div>
		<br><div class="row">
			<div class="col-sm-2">
				capital
				<br>
				<input type="text" class='form-control' name="capital" id="capital">
			</div>
		</div>
		<br>
		<input type="submit" value='create'>
		<br>
		{[Form::close()]}
		<a href="{[URL::to('estado/'.$estado_id.'/visiblecidade')]}">Back to cidade</a>
		<br>
		<br>
		<br>
	</div>
</body>