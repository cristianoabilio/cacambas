<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Edit {[$subclasse->nome]} subclasse</h1>
		{[ Form::model($subclasse, array('route' => array('subclasse.update', $id), 'method' => 'PUT')) ]}
		<div class="row">
			<div class="col-sm-2">
				nome
				<br>
				<input type="text" class='form-control' name="nome" id="nome" value="{[$subclasse->nome]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				detalhe
				<br>
				<input type="text" class='form-control' name="detalhe" id="detalhe" value="{[$subclasse->detalhe]}">
			</div>
		</div>
		<br>
		<input type="submit" value='SAVE CHANGES'>
		<br>
		<br>
		<br>
		{[Form::close()]}
		<br>
		{[ Form::model($subclasse, array('route' => array('subclasse.destroy', $id), 'method' => 'DELETE')) ]}
		<input type='submit' value='DELETE'>
		{[Form::close()]}
		<br>
		<a href="{[URL::to('visiblesubclasse')]}">Back to subclasse index</a>
		<br>
		<br>
		<br>
	</div>
</body>