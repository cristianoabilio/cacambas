<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<div class='container' >
	<h1>Create a new "perfil"</h1>
	{[ Form::open( array('url'=>URL::to('perfil')) ) ]}
	 <br>
 <br>
 <br>

		<div class="row">
			<div class="col-sm-2">
				perfil_id_pai
				<br>
				<input type="text" class='form-control' name="perfil_id_pai" id="perfil_id_pai">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				nome
				<br>
				<input type="text" class='form-control' name="nome" id="nome">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				descricao
				<br>
				<input type="text" class='form-control' name="descricao" id="descricao">
			</div>
		</div>
		<br>
		<br>
		<input class='btn btn-primary' type="submit" value='create'>
		<br>
	{[Form::close()]}
	<a href="{[URL::to('visibleperfil') ]}">Back to perfil index</a>
</div>