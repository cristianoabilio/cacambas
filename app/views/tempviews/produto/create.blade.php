<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Add a new produto</h1>
		{[Form::open(array('URL'=>URL::to('produto')  )  )]}
			<div class="row">
				<div class="col-sm-2">
					nome
					<br>
					<input type="text" name="nome" id="nome" class='form-control'>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2">
					descricao
					<br>
					<input type="text" name="descricao" id="descricao" class='form-control'>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2">
					requisitos
					<br>
					<input type="text" name="requisitos" id="requisitos" class='form-control'>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2">
					url_imagem
					<br>
					<input type="text" name="url_imagem" id="url_imagem" class='form-control'>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2">
					url_video
					<br>
					<input type="text" name="url_video" id="url_video" class='form-control'>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2">
					valor
					<br>
					<input type="text" name="valor" id="valor" class='form-control'>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2">
					custo_extra
					<br>
					<input type="text" name="custo_extra" id="custo_extra" class='form-control'>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2">
					servico
					<br>
					<input type="text" name="servico" id="servico" class='form-control'>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2">
					limite
					<br>
					<input type="text" name="limite" id="limite" class='form-control'>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2">
					observacao
					<br>
					<input type="text" name="observacao" id="observacao" class='form-control'>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2">
					perfil_id
					<br>
					<input type="text" name="perfil_id" id="perfil_id" class='form-control'>
				</div>
			</div>
			<br>
			<input type="submit" value='create'>
			<br>
			
		{[Form::close()]}
		<a href="{[URL::to('produto') ]}">Back to produto index</a>
	</div>
</body>