<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Edit {[$equipamentodetail->nome]}</h1>
		{[ Form::model($equipamentodetail, array('route' => array('equipamentodetail.update', $equipamentodetail->id), 'method' => 'PUT')) ]}
		<div class="row">
			<div class="col-sm-3">
				equipamentobase_id no editable: {[$equipamentodetail->equipamentobase_id]}
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-3">
				empresa_id no editable: {[$equipamentodetail->empresa_id]}
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-3">
				preco_base
				<br>
				<input type="text" class="form-control" name="preco_base" id="preco_base" value="{[$equipamentodetail->preco_base]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-3">
				periodo_minimo
				<br>
				<input type="text" class="form-control" name="periodo_minimo" id="periodo_minimo" value="{[$equipamentodetail->periodo_minimo]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-3">
				dia_extra
				<br>
				<input type="text" class="form-control" name="dia_extra" id="dia_extra" value="{[$equipamentodetail->dia_extra]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-3">
				preco_extra
				<br>
				<input type="text" class="form-control" name="preco_extra" id="preco_extra" value="{[$equipamentodetail->preco_extra]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-3">
				taxa_extra
				<br>
				<input type="text" class="form-control" name="taxa_extra" id="taxa_extra" value="{[$equipamentodetail->taxa_extra]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-3">
				multa
				<br>
				<input type="text" class="form-control" name="multa" id="multa" value="{[$equipamentodetail->multa]}">
			</div>
		</div>
		<br>
		<br>
		<br>
		<input type="submit" value='SAVE CHANGES'>
		{[Form::close()]}
		<br>
		<a href="{[URL::to('visibleequipamentodetail')]} ">Back to equipamentodetail index</a>
	</div>
</body>
