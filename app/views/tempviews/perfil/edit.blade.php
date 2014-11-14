<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Edit perfil {[$perfil->nome]} </h1>
		{[ Form::model($perfil, array('route' => array('perfil.update', $id), 'method' => 'PUT')) ]}
		<div class="row">
			<div class="col-sm-2">
				perfil_id_pai
				<br>
				<input type="text" class='form-control' name="perfil_id_pai" id="perfil_id_pai" value="{[$perfil->perfil_id_pai]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				nome
				<br>
				<input type="text" class='form-control' name="nome" id="nome" value="{[$perfil->nome]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				descricao
				<br>
				<input type="text" class='form-control' name="descricao" id="descricao" value="{[$perfil->descricao]}">
			</div>
		</div>
		<br>
		<br>
		<input type="submit" value='SAVE CHANGES'>
		<br>
		{[Form::close()]}
		<br>
		<br>
		{[ Form::model($perfil, array('route' => array('perfil.destroy', $perfil->id), 'method' => 'DELETE')) ]}
			<input type="submit" value='DELETE THIS RECORD'>
		{[Form::close()]}
	</div>
</body>
