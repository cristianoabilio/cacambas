<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Perfil specifications</h1>
		@foreach($header as $h)
			<div class="row">
				<div class="col-sm-2">
					{[$h[0] ]}
				</div>
				<div class="col-sm-6 text-info">
					{[$perfil->$h[0]   ]}
				</div>
			</div>
		@endforeach
		<br>
		<hr>
		<a href="{[URL::to('perfil/'.$id.'/edit')]} "> ....  Edit .... </a><br>
		{[ Form::model($perfil, array('route' => array('perfil.destroy', $perfil->id), 'method' => 'DELETE')) ]}
			<input type="submit" value='DELETE'>
		{[Form::close()]}
		<br>
		<a href="{[URL::to('visibleperfil')]}">Back to perfil</a>
	</div>
</body>

		
		