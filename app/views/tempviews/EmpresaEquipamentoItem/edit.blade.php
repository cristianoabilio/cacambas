<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Edit equipamento number {[$id]} for empresa {[$empresa_id]}</h1>
		Data is related to next resources
		<ul>
			<li>Empresa: {[$empresa->nome]}</li>
			<li>Equipamento: {[$equipamento->classe]} ({[$equipamento->nome]})</li>
		</ul>
		{[ Form::model($equipamentoitem, array('route' => array('empresa.equipamento.items.update', $empresa_id,$equipamentodetail_id,$id), 'method' => 'PUT')) ]}
		<div class="row">
			<div class="col-sm-3">
				codigo
				<br>
				<input type="text" class='form-control' name="codigo" id="codigo" value="{[$equipamentoitem->codigo]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-3">
				rfid
				<br>
				<input type="text" class='form-control' name="rfid" id="rfid" value="{[$equipamentoitem->rfid]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-3">
				qrcode
				<br>
				<input type="text" class='form-control' name="qrcode" id="qrcode" value="{[$equipamentoitem->qrcode]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-3">
				gps
				<br>
				<input type="text" class='form-control' name="gps" id="gps" value="{[$equipamentoitem->gps]}">
			</div>
		</div>
		<br>
		<br>
		<input type="submit" value='SAVE CHANGES'>
		{[Form::close()]}
		<a href="{[URL::to('empresa/'.$empresa_id.'/equipamento/'.$equipamentodetail_id.'/visibleitems')]}">Return to equipamento index</a>
		<br>
		<br>
		<br>
	</div>
</body>
