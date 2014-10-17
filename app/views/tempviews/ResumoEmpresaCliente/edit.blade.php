<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Editing resumoempresacliente</h1>
		
		
		{[ Form::model($resumoempresacliente, array('route' => array('resumoempresacliente.update', $resumoempresacliente->id), 'method' => 'PUT')) ]}
		<div class="row">
			<div class="col-sm-2">
				cliente_id
				<br>
				<input type="text" name="cliente_id" id="cliente_id" value="{[$resumoempresacliente->cliente_id]}" class='form-control'>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				mes_referencia
				<br>
				<input type="text" name="mes_referencia" id="mes_referencia" value="{[$resumoempresacliente->mes_referencia]}" class='form-control'>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				ano_referencia
				<br>
				<input type="text" name="ano_referencia" id="ano_referencia" value="{[$resumoempresacliente->ano_referencia]}" class='form-control'>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				total_locacoes
				<br>
				<input type="text" name="total_locacoes" id="total_locacoes" value="{[$resumoempresacliente->total_locacoes]}" class='form-control'>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				total_aberto
				<br>
				<input type="text" name="total_aberto" id="total_aberto" value="{[$resumoempresacliente->total_aberto]}" class='form-control'>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				total_recebido
				<br>
				<input type="text" name="total_recebido" id="total_recebido" value="{[$resumoempresacliente->total_recebido]}" class='form-control'>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				total_atrasado
				<br>
				<input type="text" name="total_atrasado" id="total_atrasado" value="{[$resumoempresacliente->total_atrasado]}" class='form-control'>
			</div>
		</div>
		<br>
		<input type="submit" value='SAVE CHANGES'>
	{[Form::close()]}
	</div>
</body>