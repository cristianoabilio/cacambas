<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Classe {[$classe->id]} resource</h1>
		@foreach($header as $h)
			<div class="row">
				<div class="col-sm-2">{[$h[0] ]}</div>
				<div class="col-sm-6">{[$classe->$h[0] ]}</div>
			</div>
			
		@endforeach
		<a href="{[URL::to('classe/'.$id.'/edit')]} "> ....  Edit .... </a>
		<br>
		<br>
		<br>
		{[ Form::model($classe, array('route' => array('classe.destroy', $id), 'method' => 'DELETE')) ]}
		Pending to delete children subclasses of current classe (not set yet)
		<input type='submit' value='DELETE'>
		{[Form::close()]}

		<br><br>
		<a href="{[URL::to('visibleclasse')]}">Back to classe index</a>
		<br>
		<br>
		<br>
	</div>
</body>
