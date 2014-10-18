<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container ">
		<h1>New resumoempresacliente</h1>
		{[Form::open( array('url'=>URL::to('empresa/'.$empresa_id.'/resumoempresacliente')) ) ]}
		<div class="row">
			<div class="col-sm-2">
				cliente_id
				<br>
				<input type="text" name="cliente_id" id="cliente_id" class='form-control'>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				mes_referencia
				<br>
				<input type="text" name="mes_referencia" id="mes_referencia" class='form-control'>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				ano_referencia
				<br>
				<input type="text" name="ano_referencia" id="ano_referencia" class='form-control'>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				total_locacoes
				<br>
				<input type="text" name="total_locacoes" id="total_locacoes" class='form-control'>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				total_aberto
				<br>
				<input type="text" name="total_aberto" id="total_aberto" class='form-control'>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				total_recebido
				<br>
				<input type="text" name="total_recebido" id="total_recebido" class='form-control'>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				total_atrasado
				<br>
				<input type="text" name="total_atrasado" id="total_atrasado" class='form-control'>
			</div>
		</div>
		<br>
		<input type="submit" value='create'>
		{[Form::close()]}
		<a href="{[URL::to('empresa/'.$empresa_id.'/visibleresumoempresacliente')]}">Go back to resumoempresa</a>
	</div>
</body>
