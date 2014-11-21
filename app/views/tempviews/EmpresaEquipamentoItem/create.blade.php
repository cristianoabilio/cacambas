<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>
			Add a new item to equipamento for empresa 
		</h1>
		Data is related to next resources
		<ul>
			<li>Empresa: {[$empresa->nome]}</li>
			<li>Equipamento: {[$equipamento->classe]} ({[$equipamento->nome]})</li>
		</ul>
		{[Form::open(array('url'=>URL::to('empresa/'.$empresa_id.'/equipamento/'.$equipamentodetail_id.'/items') ))]}
		 <br><div class="row">
			<div class="col-sm-3">
				codigo
				<br>
				<input type="text" class='form-control' name="codigo" id="codigo">
			</div>
		</div>
		<br>
		<div id="preco_form" class=''>
			<div class="row">
				<div class="col-sm-3">
					rfid
					<br>
					<input type="text" class='form-control' name="rfid" id="rfid">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-3">
					qrcode
					<br>
					 <input type="text" class='form-control' name="qrcode" id="qrcode">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-3">
					gps
					<br>
					<input type="text" class='form-control' name="gps" id="gps">
				</div>
			</div>
			<br>
			<br>
			<input type="submit" value='create'>
		</div>
		{[Form::close()]}
		<br>
		<a href="{[URL::to('empresa/'.$empresa_id.'/equipamento/'.$equipamentodetail_id.'/visibleitems')]}">Return to equipamento index</a>
		<br>
		<br>
		<br>
	</div>
</body>
<script type="text/javascript">
	//
</script>




