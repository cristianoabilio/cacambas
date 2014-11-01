<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Add a new "bairro" for cidade {[$cidade->nome]} on estado {[$cidade->Estado->nome]}</h1>
		{[Form::open(array('url'=>URL::to('estado/'.$estado_id.'/cidade/'.$cidade_id.'/bairro')))]}
		<div class="row">
			<div class="col-sm-3">
				zona
				<br>
				<input type="text" class='form-control' name="zona" id="zona">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-3">
				nome
				<br>
				<input type="text" class='form-control' name="nome" id="nome">
			</div>
		</div>
		<br>
		<input type="submit" value='create'>
		
		{[Form::close()]}
		<a href="{[URL::to('estado/'.$estado_id.'/cidade/'.$cidade_id.'/visiblebairro')]}">Back to bairro index</a>
	</div>
</body>