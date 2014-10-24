<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Data for produtocompra {[$id]} </h1>
		@foreach($header as $h)
			<div class="row">
				<div class="col-sm-2">{[$h[0] ]}</div>
				<div class="col-sm-6">{[$produtocompra->$h[0]   ]}</div>
			</div>
		@endforeach
		<br>
		<br>
		<br>

		<a href="{[URL::to('produtocompra/'.$id.'/edit')]} "> ....  Edit .... </a>
		<br>
		<br>
		<a href="{[URL::to('visibleprodutocompra')]}">Back to produto</a>
	</div>
</body>