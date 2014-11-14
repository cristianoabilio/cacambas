<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Sessao {[$sessao->id]} resource</h1>
		@foreach($header as $h)
			<div class="row">
				<div class="col-sm-2">{[$h[0] ]}</div>
				<div class="col-sm-6">{[$sessao->$h[0] ]}</div>
			</div>
			
		@endforeach
		<a href="{[URL::to('sessao/'.$id.'/edit')]} "> ....  Edit .... </a>
		<br>

		<br><br>
		<a href="{[URL::to('visiblesessao')]}">Back to sessao index</a>
		<br>
		<br>
		<br>
	</div>
</body>