<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Add a new "estado"</h1>
		{[Form::open(array('url'=>URL::to('estado')))]}
		<div class="row">
			<div class="col-sm-3">
				nome
				<br>
				<input type="text" class='form-control' name="nome" id="nome">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-3">
				regiao
				<br>
				<input type="text" class='form-control' name="regiao" id="regiao">
			</div>
		</div>
		<br>
		<input type="submit" value='create'>
		{[Form::close()]}
		<br>
		<a href="{[URL::to('visibleestado')]} ">Back to estado index</a>
	</div>
</body>