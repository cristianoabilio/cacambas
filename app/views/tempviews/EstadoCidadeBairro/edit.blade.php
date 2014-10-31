<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>
			Edit {[$bairro->nome]}
		</h1>
		{[Form::model($bairro, array('route' => array('estado.cidade.bairro.update', $estado_id,$cidade_id,$id ), 'method' => 'PUT') )]}
		<div class="row">
			<div class="col-sm-3">
				zona
				<br>
				<input type="text" class='form-control' name="zona" id="zona" value="{[$bairro->zona]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-3">
				nome
				<br>
				<input type="text" class='form-control' name="nome" id="nome" value="{[$bairro->nome]}">
			</div>
		</div>
		<br>
		<input type="submit" value='update'>
		{[Form::close()]}
	</div>
</body>