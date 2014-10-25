<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Add a new "classe"</h1>
		{[Form::open(array('url'=>URL::to('classe') ))]}
		<div class="row">
			<div class="col-sm-2">
				nome
				<br>
				<input type="text" class='form-control' name="nome" id="nome"><br>
			</div>
		</div>
		<br><div class="row">
			<div class="col-sm-2">
				descricao
				<br>
				<input type="text" class='form-control' name="descricao" id="descricao">
			</div>
		</div>
		<br>
		<input type="submit" value='create'>
		<br>
		{[Form::close()]}
		<a href="{[URL::to('visibleclasse')]}">Back to classe</a>
		<br>
		<br>
		<br>
	</div>
</body>