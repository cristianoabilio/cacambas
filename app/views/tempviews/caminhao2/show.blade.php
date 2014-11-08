<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Caminhao {[$caminhao->id]} resource</h1>
		@foreach($header as $h)
			<div class="row">
				<div class="col-sm-2">{[$h[0] ]}</div>
				<div class="col-sm-6">{[$caminhao->$h[0] ]}</div>
			</div>
			
		@endforeach
		<a href="{[URL::to('caminhao2/'.$id.'/edit')]} "> ....  Edit .... </a>
		<br>
		<br>
		<br>
		{[ Form::model($caminhao, array('route' => array('caminhao2.destroy', $id), 'method' => 'DELETE')) ]}
		Pending to delete children subcaminhaos of current caminhao (not set yet)
		<input type='submit' value='DELETE'>
		{[Form::close()]}

		<br><br>
		<a href="{[URL::to('visiblecaminhao2')]}">Back to caminhao index</a>
		<br>
		<br>
		<br>
	</div>
</body>
