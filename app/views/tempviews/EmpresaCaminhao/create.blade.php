<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Add a new "caminhao"</h1>
		{[Form::open(array('url'=>URL::to('empresa/'.$empresa_id.'/caminhao/') ))]}
		<div class="row">
			<div class="col-sm-2">
				placa
				<br>
				<input type="text" class='form-control' name="placa" id="placa">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				renavan
				<br>
				<input type="text" class='form-control' name="renavan" id="renavan">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				marca
				<br>
				<input type="text" class='form-control' name="marca" id="marca">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				modelo
				<br>
				<input type="text" class='form-control' name="modelo" id="modelo">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				apelido
				<br>
				<input type="text" class='form-control' name="apelido" id="apelido">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				gps
				<br>
				<input type="text" class='form-control' name="gps" id="gps">
			</div>
		</div>
		<br>
		<input type="submit" value='create'>
		<br>
		{[Form::close()]}
		<a href="{[URL::to('empresa/'.$empresa_id.'/visiblecaminhao')]}">Back to caminhao index</a>
		<br>
		<br>
		<br>
	</div>
</body>