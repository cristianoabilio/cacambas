<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Edit {[$cidade->nome]}</h1>
		{[ Form::model($cidade, array('route' => array('cidade.update', $id), 'method' => 'PUT')) ]}
		<div class="row">
			<div class="col-sm-2">
				estado_id
				<br>
				<input type="text" class='form-control' name="estado_id" id="estado_id" value="{[$cidade->estado_id]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				nome
				<br>
				<input type="text" class='form-control' name="nome" id="nome" value="{[$cidade->nome]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				capital
				<br>
				<input type="text" class='form-control' name="capital" id="capital" value="{[$cidade->capital]}">
			</div>
		</div>
		<br>
		<input type="submit" value='SAVE CHANGES'>
		<br>
		<br>
		<br>
		{[Form::close()]}
		<br>
		<a href="{[URL::to('visiblecidade')]}">Back to cidade</a>
		<br>
		<br>
		<br>
	</div>
</body>
