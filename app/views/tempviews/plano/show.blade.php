<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Plan specifications</h1>
		@foreach($header as $h)
			<div class="row">
				<div class="col-sm-2">
					{[$h[0] ]}
				</div>
				<div class="col-sm-6 text-info">
					{[$plano->$h[0]   ]}
				</div>
			</div>
		@endforeach
		<br>
		<h3 class="muted">Limite for current plano</h3>
		@foreach($limiteheader as $h)
			<div class="row">
				<div class="col-sm-2">{[$h[0] ]}</div>
				<div class="col-sm-6">
					{[$plano->limite->$h[0] ]}
				</div>
			</div>
		@endforeach
		<hr>
		<a href="{[URL::to('plano/'.$id.'/edit')]} "> ....  Edit .... </a><br>
		{[ Form::model($plano, array('route' => array('plano.destroy', $plano->id), 'method' => 'DELETE')) ]}
			<input type="submit" value='DELETE'>
		{[Form::close()]}
		<br>
		<a href="{[URL::to('visibleplano')]}">Back to plano</a>
	</div>
</body>

		
		