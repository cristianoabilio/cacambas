<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Edit {[$equipamentobase->nome]}</h1>
		{[ Form::model($equipamentobase, array('route' => array('equipamentobase.update', $equipamentobase->id), 'method' => 'PUT')) ]}
		<div class="row">
			<div class="col-sm-3">
				nome
				<br>
				<input type="text" class='form-control' name="nome" id="nome" value="{[$equipamentobase->nome]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-3">
				classe
				<br>
				<input type="text" class='form-control' name="classe" id="classe" value="{[$equipamentobase->classe]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-3">
				subclasse
				<br>
				<input type="text" class='form-control' name="subclasse" id="subclasse" value="{[$equipamentobase->subclasse]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-3">
				descricao
				<br>
				<input type="text" class='form-control' name="descricao" id="descricao" value="{[$equipamentobase->descricao]}">
			</div>
		</div>
		<br>
		<input type="submit" value='SAVE CHANGES'>
		{[Form::close()]}
		<br>
		<a href="{[URL::to('visibleequipamentobase')]} ">Back to equipamentobase index</a>
	</div>
</body>
