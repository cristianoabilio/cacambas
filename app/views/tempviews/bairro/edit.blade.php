<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Edit resource number {[$id]}</h1>
		{[ Form::model($bairro, array('route' => array('bairro.update', $bairro->id), 'method' => 'PUT')) ]}
		<div class="row">
			<div class="col-sm-2">
				cidade_id
				<br>
				<input type="text" class='form-control' name="cidade_id" id="cidade_id" value="{[$bairro->cidade_id]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				estado_id
				<br>
				<input type="text" class='form-control' name="estado_id" id="estado_id" value="{[$bairro->estado_id]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				zona
				<br>
				<input type="text" class='form-control' name="zona" id="zona" value="{[$bairro->zona]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				nome
				<br>
				<input type="text" class='form-control' name="nome" id="nome" value="{[$bairro->nome]}">
			</div>
		</div>
		<br>
		<input type="submit" value='SAVE CHANGES'>
		{[Form::close()]}
	</div>
</body>