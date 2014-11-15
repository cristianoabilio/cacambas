<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Edit {[$equipamentobasepreco->nome]}</h1>
		{[ Form::model($equipamentobasepreco, array('route' => array('equipamentobasepreco.update', $equipamentobasepreco->id), 'method' => 'PUT')) ]}
		<div class="row">
			<div class="col-sm-3">
				equipamentobase_id no editable: {[$equipamentobasepreco->equipamentobase_id]}
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-3">
				empresa_id no editable: {[$equipamentobasepreco->empresa_id]}
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-3">
				preco_base
				<br>
				<input type="text" class="form-control" name="preco_base" id="preco_base" value="{[$equipamentobasepreco->preco_base]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-3">
				periodo_minimo
				<br>
				<input type="text" class="form-control" name="periodo_minimo" id="periodo_minimo" value="{[$equipamentobasepreco->periodo_minimo]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-3">
				dia_extra
				<br>
				<input type="text" class="form-control" name="dia_extra" id="dia_extra" value="{[$equipamentobasepreco->dia_extra]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-3">
				preco_extra
				<br>
				<input type="text" class="form-control" name="preco_extra" id="preco_extra" value="{[$equipamentobasepreco->preco_extra]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-3">
				taxa_extra
				<br>
				<input type="text" class="form-control" name="taxa_extra" id="taxa_extra" value="{[$equipamentobasepreco->taxa_extra]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-3">
				multa
				<br>
				<input type="text" class="form-control" name="multa" id="multa" value="{[$equipamentobasepreco->multa]}">
			</div>
		</div>
		<br>
		<br>
		<br>
		<input type="submit" value='SAVE CHANGES'>
		{[Form::close()]}
		<br>
		<a href="{[URL::to('visibleequipamentobasepreco')]} ">Back to equipamentobasepreco index</a>
	</div>
</body>
