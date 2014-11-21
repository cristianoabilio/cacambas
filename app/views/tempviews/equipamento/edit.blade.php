<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Edit {[$equipamento->nome]}</h1>
		{[ Form::model($equipamento, array('route' => array('equipamento.update', $equipamento->id), 'method' => 'PUT')) ]}
		<div class="row">
			<div class="col-sm-3">
				nome
				<br>
				<input type="text" class='form-control' name="nome" id="nome" value="{[$equipamento->nome]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-3">
				classe
				<br>
				<input type="text" class='form-control' name="classe" id="classe" value="{[$equipamento->classe]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-3">
				subclasse
				<br>
				<input type="text" class='form-control' name="subclasse" id="subclasse" value="{[$equipamento->subclasse]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-3">
				descricao
				<br>
				<input type="text" class='form-control' name="descricao" id="descricao" value="{[$equipamento->descricao]}">
			</div>
		</div>
		<br>
		<input type="submit" value='SAVE CHANGES'>
		{[Form::close()]}
		<br>
		{[ $destroy]}
		<br>
		<a href="{[URL::to('visibleequipamento')]} ">Back to equipamento index</a>
	</div>
</body>
