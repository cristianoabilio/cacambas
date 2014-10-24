<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Edit produtocompra {[$id]} </h1>
		{[ Form::model($produtocompra, array('route' => array('produtocompra.update', $id), 'method' => 'PUT')) ]}
		<div class="row">
			<div class="col-sm-2">
				produtofatura_id
				<br>
				<input type="text" class='form-control' name="produtofatura_id" id="produtofatura_id" value="{[$produtocompra->produtofatura_id]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				amount
				<br>
				<input type="text" class='form-control' name="amount" id="amount" value="{[$produtocompra->amount]}">	
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				produto_id
				<br>
				<input type="text" class='form-control' name="produto_id" id="produto_id" value="{[$produtocompra->produto_id]}">
			</div>
		</div>
		<br>
		<input type="submit" value='SAVE CHANGES'>
		{[Form::close()]}
		<br>
		<a href="{[URL::to('visibleprodutocompra')]}">go back to produtocompra index</a>
		<br>
		<br>
		<br>
	</div>
</body>
