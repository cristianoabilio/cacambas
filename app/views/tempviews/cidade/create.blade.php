<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Add a new "cidade"</h1>
		{[Form::open(array('url'=>URL::to('cidade') ))]}
		<div class="row">
			<div class="col-sm-2">
				estado_id
				<br>
				<input type="text" class='form-control' name="estado_id" id="estado_id">
			</div>
		</div>
		<br>
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
		<a href="{[URL::to('visiblecidade')]}">Back to cidade</a>
		<br>
		<br>
		<br>
	</div>
</body>