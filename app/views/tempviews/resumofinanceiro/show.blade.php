<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Data for resumofinanceiro {[$id]}</h1>
		@foreach($header as $h)
		<div class="row">
			<div class="col-sm-2">{[$h[0] ]}</div>
			<div class="col-sm-6">{[$resumofinanceiro->$h[0]   ]}</div>
		</div>
		@endforeach
		<a href="{[URL::to('resumofinanceiro/'.$id.'/edit')]} "> ....  Edit .... </a>
		<br>
		<br>
		<a href="{[URL::to('visibleresumofinanceiro')]}">Back to resumofinanceiro</a>
	</div>
</body>
