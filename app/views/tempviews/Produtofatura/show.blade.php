<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Data for produtofatura {[$id]} </h1>
		@foreach($header as $h)
			<div class="row">
				<div class="col-sm-2">{[$h[0] ]}</div>
				<div class="col-sm-6">{[$produtofatura->$h[0]   ]}</div>
			</div>
		@endforeach
		<br>
		<br>
		<br>

		<a href="{[URL::to('produtofatura/'.$id.'/edit')]} "> ....  Edit .... </a>
		<br>
		<br>
		<a href="{[URL::to('visibleprodutofatura')]}">Back to produto</a>
	</div>
</body>