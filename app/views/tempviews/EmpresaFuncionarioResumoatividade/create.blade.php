<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Add new "resumoatividade" for funcionario {[Funcionario::find($funcionario_id)->nome]}</h1>
		<h2 class="text-danger">Sorry, resource cannot be created as it is autogenerated</h2>
		<div class="hide">
			{[Form::open(array('url'=>URL::to('empresa/'.$empresa_id.'/funcionario/'.$funcionario_id.'/resumoatividade') ) )]}
			<div class="row">
				<div class="col-sm-2">
					empresa_id
					<br>
					{[$empresa_id]} (RESTful resource)
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2">
					funcionario_id
					<br>
					{[$funcionario_id]} (RESTful resource)
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2">
					mes_referencia
					<br>
					<input type="text" class='form-control' name="mes_referencia" id="mes_referencia">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2">
					ano_referencia
					<br>
					<input type="text" class='form-control' name="ano_referencia" id="ano_referencia">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2">
					total_os_colocada
					<br>
					<input type="text" class='form-control' name="total_os_colocada" id="total_os_colocada">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2">
					total_os_troca
					<br>
					<input type="text" class='form-control' name="total_os_troca" id="total_os_troca">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2">
					total_os_retirada
					<br>
					<input type="text" class='form-control' name="total_os_retirada" id="total_os_retirada">
				</div>
			</div>
			<br>
			<input type="submit" value='create'>
			{[Form::close()]}
		</div>
		<br>
		<a href="{[URL::to('empresa/'.$empresa_id.'/funcionario/'.$funcionario_id.'/visibleresumoatividade')]}">Go back to funcionario index</a>
	</div>
</body>
