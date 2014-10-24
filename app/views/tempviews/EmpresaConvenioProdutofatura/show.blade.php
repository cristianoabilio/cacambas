<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Produtofatura resource number {[$id]}</h1>
		@foreach($header as $h)
		<div class="row">
			<div class="col-sm-2">{[$h[0] ]}</div>
			<div class="col-sm-6">{[$produtofatura->$h[0]   ]}</div>
		</div>
		@endforeach
		<h3>purchased products</h3>
		@foreach($produtofatura->produtocompra as $p)
			<div class="row">
				<div class="col-sm-2">{[$p->produto->nome]}</div>
				<div class="col-sm-6">{[$p->amount]} units</div>
			</div>
		@endforeach
		<hr>
		<a href="{[URL::to('empresa/'.$empresa_id.'/produtofatura/'.$id.'/edit')]} "> ....  Edit .... </a>
		<br>
		<br>
		<a href="{[URL::to('empresa/'.$empresa_id.'/convenio/'.$convenio_id.'/visibleprodutofatura') ]}">Back to produtofatura index</a>
		<br>
		<br>
		<br>
	</div>
</body>