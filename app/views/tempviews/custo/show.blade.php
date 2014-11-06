<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Custo resource number {[$id]}</h1>
		@foreach($header as $h)
		<div class="row">
			<div class="col-sm-2">{[$h[0] ]}</div>
			<div class="col-sm-6">{[$custo->$h[0]   ]}</div>
		</div>
		@endforeach
		<a href="{[URL::to('custo/'.$id.'/edit')]} "> ....  Edit .... </a>
		<br>
		<br>
		<a href="{[URL::to('visiblecusto')]}  ">Back to custo</a>
		{[ Form::model($custo, array('route' => array('custo.destroy', $custo->id), 'method' => 'DELETE')) ]}
		<input type="submit" value='DELETE' class='btn btn-link'>
		{[Form::close()]}
	</div>
</body>