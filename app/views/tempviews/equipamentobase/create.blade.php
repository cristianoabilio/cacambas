<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Add a new "equipamentobase"</h1>
		{[Form::open(array('url'=>URL::to('equipamentobase')))]}
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
				classe
				<br>
				<input type="text" class='form-control' name="classe" id="classe">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-3">
				subclasse
				<br>
				<input type="text" class='form-control' name="subclasse" id="subclasse">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-3">
				descricao
				<br>
				<input type="text" class='form-control' name="descricao" id="descricao">
			</div>
		</div>
		<br>
		<br>
		<input type="submit" value='create'>
		{[Form::close()]}
		<br>
		<a href="{[URL::to('visibleequipamentobase')]} ">Back to equipamentobase index</a>
	</div>
</body>