<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Edit {[$estado->nome]}</h1>
		{[ Form::model($estado, array('route' => array('estado.update', $estado->id), 'method' => 'PUT')) ]}
		<div class="row">
			<div class="col-sm-3">
				nome
				<br>
				<input type="text" class='form-control' name="nome" id="nome" value="{[$estado->nome]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-3">
				regiao
				<br>
				<input type="text" class='form-control' name="regiao" id="regiao" value="{[$estado->regiao]}">
			</div>
		</div>
		<br>
		<input type="submit" value='SAVE CHANGES'>
		{[Form::close()]}
		<br>
		<a href="{[URL::to('visibleestado')]} ">Back to estado index</a>
	</div>
</body>
