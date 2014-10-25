<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Subclasse {[$subclasse->id]} resource</h1>
		@foreach($header as $h)
			<div class="row">
				<div class="col-sm-2">{[$h[0] ]}</div>
				<div class="col-sm-6">{[$subclasse->$h[0] ]}</div>
			</div>
			
		@endforeach
		<a href="{[URL::to('classe/'.$classe_id.'/subclasse/'.$id.'/edit')]} "> ....  Edit .... </a>
		<br>
		{[ Form::model($subclasse, array('route' => array('classe.subclasse.destroy', $classe_id,$id), 'method' => 'DELETE')) ]}
		<input type='submit' value='DELETE'>
		{[Form::close()]}

		<br><br>
		<a href="{[URL::to('classe/'.$classe_id.'/visiblesubclasse')]}">Back to subclasse index</a>
		<br>
		<br>
		<br>
	</div>
</body>