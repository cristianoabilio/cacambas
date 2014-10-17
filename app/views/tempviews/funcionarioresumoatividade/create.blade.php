<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>New resumoatividade for <b>{[$funcionario->nome]}</b></h1>
		Add a new "resumoatividade" for <b>{[$funcionario->nome]}</b>
		{[Form::open(array('url'=>URL::to('funcionario/'.$funcionario->id.'/resumoatividade') ) )]}
		<div class="row">
			<div class="col-sm-2">mes_referencia</div>
			<div class="col-sm-3"><input type="text" name="mes_referencia" id="mes_referencia" class='form-control'></div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">ano_referencia</div>
			<div class="col-sm-3"><input type="text" name="ano_referencia" id="ano_referencia" class='form-control'></div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">total_os_colocada</div>
			<div class="col-sm-3"><input type="text" name="total_os_colocada" id="total_os_colocada" class='form-control'></div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">total_os_troca</div>
			<div class="col-sm-3"><input type="text" name="total_os_troca" id="total_os_troca" class='form-control'></div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">total_os_retirada</div>
			<div class="col-sm-3"><input type="text" name="total_os_retirada" id="total_os_retirada" class='form-control'></div>
		</div>
		<br>
		<input type="submit" value='create'>
		{[Form::close()]}
	</div>
</body>