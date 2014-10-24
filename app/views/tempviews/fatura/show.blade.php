<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Fatura resource number {[$id]}</h1>
		@foreach($header as $h)
		<div class="row">
			<div class="col-sm-2">{[$h[0] ]}</div>
			<div class="col-sm-6">{[$fatura->$h[0]   ]}</div>
		</div>
		@endforeach
		<a href="{[URL::to('fatura/'.$id.'/edit')]} "> ....  Edit .... </a>
		<br>
		<br>
		<a href="{[URL::to('visiblefatura')]}">Back to fatura</a>
	</div>
</body>

		