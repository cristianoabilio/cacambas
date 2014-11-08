<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Edit {[$caminhao->placa]} caminhao</h1>
		{[ Form::model($caminhao, array('route' => array('caminhao2.update', $id), 'method' => 'PUT')) ]}
		<div class="row">
			<div class="col-sm-2">
				empresa_id no editable {[$caminhao->empresa_id ]}<input type="hidden" name="empresa_id" id="empresa_id" value="{[$caminhao->empresa_id]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				placa
				<br>
				<input type="text" class='form-control' name="placa" id="placa" value="{[$caminhao->placa]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				renavan
				<br>
				<input type="text" class='form-control' name="renavan" id="renavan" value="{[$caminhao->renavan]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				marca
				<br>
				<input type="text" class='form-control' name="marca" id="marca" value="{[$caminhao->marca]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				modelo
				<br>
				<input type="text" class='form-control' name="modelo" id="modelo" value="{[$caminhao->modelo]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				apelido
				<br>
				<input type="text" class='form-control' name="apelido" id="apelido" value="{[$caminhao->apelido]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				status
				<br>
				<input type="text" class='form-control' name="status" id="status" value="{[$caminhao->status]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				gps
				<br>
				<input type="text" class='form-control' name="gps" id="gps" value="{[$caminhao->gps]}">
			</div>
		</div>
		<br>
		<input type="submit" value='SAVE CHANGES'>
		<br>
		<br>
		<br>
		{[Form::close()]}
		<br>
		{[ Form::model($caminhao, array('route' => array('caminhao2.destroy', $id), 'method' => 'DELETE')) ]}
		<input type='submit' value='DELETE'>
		{[Form::close()]}
		<br>
		<a href="{[URL::to('visiblecaminhao2')]}">Back to caminhao index</a>
		<br>
		<br>
		<br>
	</div>
</body>
