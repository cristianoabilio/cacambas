<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Add a new "Custo" to empresa "{[$empresa->nome]}"</h1>
		{[Form::open(array('url'=>URL::to('empresa/'.$empresa_id.'/custo')))]}
			<div class="row">
				<div class="col-sm-2">
					tipo
					<br>
					<select name="tipo" class='form-control' id="tipo">
						<option value=""></option>
						<option value="caminhao">caminhao</option>
						<option value="equipamento">equipamento</option>
						<option value="funcionario">funcionario</option>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-2">
					equipamento_id 
					<br>
					<input type="text" class='form-control' name="equipamento_id" id="equipamento_id">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2">
					caminhao_id
					<br>
					<input type="text" class='form-control' name="caminhao_id" id="caminhao_id">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2">
					funcionario_id
					<br>
					<input type="text" class='form-control' name="funcionario_id" id="funcionario_id">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2">
					dt_inicio
					<br>
					<input type="text" class='form-control' name="dt_inicio" id="dt_inicio">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2">
					dt_fim
					<br>
					<input type="text" class='form-control' name="dt_fim" id="dt_fim">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2">
					valor
					<br>
					<input type="text" class='form-control' name="valor" id="valor">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2">
					status_financeiro
					<br>
					<input type="text" class='form-control' name="status_financeiro" id="status_financeiro">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2">
					prestadora
					<br>
					<input type="text" class='form-control' name="prestadora" id="prestadora">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2">
					detalhe
					<br>
					<input type="text" class='form-control' name="detalhe" id="detalhe">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2">
					classe_id (autoasigned according to "tipo")
					<br>
					<input type="text" class='form-control' name="classe_id" id="classe_id">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2">
					subclasse_id
					<br>
					<input type="text" class='form-control' name="subclasse_id" id="subclasse_id">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2">
					sessao_id
					<br>
					<input type="text" class='form-control' name="sessao_id" id="sessao_id">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2">
					dthr_cadastro
					<br>
					<input type="text" class='form-control' name="dthr_cadastro" id="dthr_cadastro">
				</div>
			</div>
			<br>
			<input type="submit" value='create'>
		{[Form::close()]}
		<br>
		<a href="{[URL::to('empresa/'.$empresa_id.'/visiblecusto')]}  ">Back to custo</a>
		<br>
		<br>
		<br>
	</div>
</body>