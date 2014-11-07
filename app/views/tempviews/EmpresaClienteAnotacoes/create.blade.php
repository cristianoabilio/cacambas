<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Add a new "Empresaclienteanotacoes"</h1>
		{[Form::open(array('url'=>URL::to('empresaclienteanotacoes')))]}
		<div class="row">
			<div class="col-sm-2">
				empresa_id
				<br>
				<input type="text" class='form-control' name="empresa_id" id="empresa_id">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				cliente_id
				<br>
				<input type="text" class='form-control' name="cliente_id" id="cliente_id">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				anotacao
				<br>
				<input type="text" class='form-control' name="anotacao" id="anotacao">
			</div>
		</div>
		<br>
		<input type="submit" value='create'>
		<br>
		{[Form::close()]}
		<a href="{[URL::to('visibleempresaclienteanotacoes')]}">Back to index</a>
	</div>
</body>