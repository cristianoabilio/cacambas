<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Add a new "subclasse" for classe resource {[$id]}</h1>
		pending to add restriction:
		<ul>
			<li>if classe id = 1 block user unless profile= admin_cacambas</li>
		</ul>
		
		{[Form::open(array('url'=>URL::to('classe/'.$id.'/subclasse') ))]}
		<div class="row">
			<div class="col-sm-2">
				nome
				<br>
				<input type="text" class='form-control' name="nome" id="nome"><br>
			</div>
		</div>
		<br><div class="row">
			<div class="col-sm-2">
				detalhe
				<br>
				<input type="text" class='form-control' name="detalhe" id="detalhe">
			</div>
		</div>
		<br>
		<input type="submit" value='create'>
		<br>
		{[Form::close()]}
		<a href="{[URL::to('classe/'.$id.'/visiblesubclasse')]}">Back to subclasse index</a>
		<br>
		<br>
		<br>
	</div>
</body>