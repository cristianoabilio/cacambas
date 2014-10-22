<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>
			Add a new "contabancaria" for empresa {[Empresa::find($empresa_id)->nome]}
		</h1>
		{[Form::open(array('url'=>URL::to('empresa/'.$empresa_id.'/contabancaria') ))]}
		<div class="row">
			<div class="col-sm-2">
				nome_banco
				<br>
				<input type="text" class='form-control' name="nome_banco" id="nome_banco">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				codigo_banco
				<br>
				<input type="text" class='form-control' name="codigo_banco" id="codigo_banco">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				conta
				<br>
				<input type="text" class='form-control' name="conta" id="conta">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				conta_dig
				<br>
				<input type="text" class='form-control' name="conta_dig" id="conta_dig">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				conta_tipo
				<br>
				<input type="text" class='form-control' name="conta_tipo" id="conta_tipo">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				agencia
				<br>
				<input type="text" class='form-control' name="agencia" id="agencia">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				agencia_dig
				<br>
				<input type="text" class='form-control' name="agencia_dig" id="agencia_dig">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				cpf_cnpj
				<br>
				<input type="text" class='form-control' name="cpf_cnpj" id="cpf_cnpj">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				pj
				<br>
				<input type="text" class='form-control' name="pj" id="pj">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				titular
				<br>
				<input type="text" class='form-control' name="titular" id="titular">
			</div>
		</div>
		<br>
		<br>
		<input type="submit" value='create'>

		{[Form::close()]}
		<br>
		<a href="{[URL::to('empresa/'.$empresa_id.'/visiblecontabancaria')]}">Return to contabancaria index</a>
		<br>
		<br>
		<br>
	</div>
</body>





