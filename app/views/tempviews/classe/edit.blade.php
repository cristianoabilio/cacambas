<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Edit {[$classe->nome]}</h1>
		{[ Form::model($classe, array('route' => array('classe.update', $id), 'method' => 'PUT')) ]}
		<div class="row">
			<div class="col-sm-2">
				nome
				<br>
				<input type="text" class='form-control' name="nome" id="nome" value="{[$classe->nome]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				descricao
				<br>
				<input type="text" class='form-control' name="descricao" id="descricao" value="{[$classe->descricao]}">
			</div>
		</div>
		<br>
		<input type="submit" value='SAVE CHANGES'>
		<br>
		<br>
		<br>
		{[Form::close()]}
		<br>
		{[ Form::model($classe, array('route' => array('classe.destroy', $id), 'method' => 'DELETE')) ]}
		<input type='submit' value='DELETE'>
		{[Form::close()]}
		<br>
		<a href="{[URL::to('visibleclasse')]}">Back to classe</a>
		<br>
		<br>
		<br>
	</div>
</body>
