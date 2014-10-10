<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Add a new compra</h1>
		{[Form::open(array('url'=>URL::to('compras') ) )]}
		<div class="row">
			<div class="col-sm-2">
				produto_id
				<br>
				<input type="text" name="produto_id" id="produto_id" class='form-control'>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				convenio_id
				<br>
				<input type="text" name="convenio_id" id="convenio_id" class='form-control'>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				limite
				<br>
				<input type="text" name="limite" id="limite" class='form-control'>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				desconto_valor
				<br>
				<input type="text" name="desconto_valor" id="desconto_valor" class='form-control'>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				desconto_percentual
				<br>
				<input type="text" name="desconto_percentual" id="desconto_percentual" class='form-control'>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				ativado
				<br>
				<input type="text" name="ativado" id="ativado" class='form-control'>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				data_compra
				<br>
				<input type="text" name="data_compra" id="data_compra" class='form-control'>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				data_ativacao
				<br>
				<input type="text" name="data_ativacao" id="data_ativacao" class='form-control'>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				data_desativacao
				<br>
				<input type="text" name="data_desativacao" id="data_desativacao" class='form-control'>
			</div>
		</div>
		<br>

		<input type="submit" value='create'>
		{[Form::close()]}
	</div>
</body>