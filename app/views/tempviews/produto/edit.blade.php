<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Edit produto {[$produto->nome]} </h1>
		{[ Form::model($produto, array('route' => array('produto.update', $produto->id), 'method' => 'PUT')) ]}
		<div class="row">
			<div class="col-sm-2">
				nome
				<br>
				<input type="text" name="nome" id="nome" value="{[$produto->nome]}" class='form-control'>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				descricao
				<br>
				<input type="text" name="descricao" id="descricao" value="{[$produto->descricao]}" class='form-control'>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				requisitos
				<br>
				<input type="text" name="requisitos" id="requisitos" value="{[$produto->requisitos]}" class='form-control'>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				url_imagem
				<br>
				<input type="text" name="url_imagem" id="url_imagem" value="{[$produto->url_imagem]}" class='form-control'>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				url_video
				<br>
				<input type="text" name="url_video" id="url_video" value="{[$produto->url_video]}" class='form-control'>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				valor
				<br>
				<input type="text" name="valor" id="valor" value="{[$produto->valor]}" class='form-control'>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				custo_extra
				<br>
				<input type="text" name="custo_extra" id="custo_extra" value="{[$produto->custo_extra]}" class='form-control'>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				servico
				<br>
				<input type="text" name="servico" id="servico" value="{[$produto->servico]}" class='form-control'>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				limite
				<br>
				<input type="text" name="limite" id="limite" value="{[$produto->limite]}" class='form-control'>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				observacao
				<br>
				<input type="text" name="observacao" id="observacao" value="{[$produto->observacao]}" class='form-control'>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				perfil_id
				<br>
				<input type="text" name="perfil_id" id="perfil_id" value="{[$produto->perfil_id]}" class='form-control'>
			</div>
		</div>
		<br>
		<input type="submit" value='SAVE CHANGES'>
		<br>
		{[Form::close()]}
		<br>
		<br>
		{[ Form::model($produto, array('route' => array('produto.destroy', $produto->id), 'method' => 'DELETE')) ]}
			<input type="submit" value='DELETE THIS RECORD'>
		{[Form::close()]}
	</div>
</body>
