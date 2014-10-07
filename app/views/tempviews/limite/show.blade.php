<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Displaying info for limite number {[$id]} </h1>
		@foreach($header as $h)
			<div class="row">
				<div class="col-sm-2">{[$h[0] ]}</div>
				<div class="col-sm-6">{[$limite->$h[0]   ]}</div>
			</div>
		@endforeach
		<div class="hide">
			<a href="{[URL::to('limite/'.$id.'/edit')]} ">
			 ....  Edit .... 
			</a>
			<br>
			{[ Form::model($limite, array('route' => array('limite.destroy', $limite->id), 'method' => 'DELETE')) ]}
				<input type="submit" value='DELETE'>
			{[Form::close()]}
		</div>
		<br>
		<a href="{[URL::to('limite')]}">Back to limite</a>
	</div>
</body>


