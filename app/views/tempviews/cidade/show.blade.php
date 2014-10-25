<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Cidade {[$cidade->id]} resource</h1>
		@foreach($header as $h)
			<div class="row">
				<div class="col-sm-2">{[$h[0] ]}</div>
				<div class="col-sm-6">{[$cidade->$h[0] ]}</div>
			</div>
			
		@endforeach
		<a href="{[URL::to('cidade/'.$id.'/edit')]} "> ....  Edit .... </a>
		<br><br>
		<a href="{[URL::to('visiblecidade')]}">Back to cidade</a>
		<br>
		<br>
		<br>
	</div>
</body>
