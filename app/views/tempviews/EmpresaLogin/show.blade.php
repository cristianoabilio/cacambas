<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>User (login) number {[$id]} for empresa {[$empresa_id]}</h1>
		@foreach($header as $h)
		<div class="row">
			<div class="col-sm-2">{[$h[0] ]}</div>
			<div class="col-sm-6">{[$login->$h[0]   ]}</div>
		</div>
		@endforeach
		<a href="{[URL::to('empresa/'.$empresa_id.'/login/'.$id.'/edit')]} "> ....  Edit .... </a>
		<br>
		
		{[ Form::model($login, array('route' => array('empresa.login.destroy', $empresa_id,$id), 'method' => 'DELETE')) ]}
		<input type='submit' value='delete'>
		{[Form::close()]}
		<br>
		<a href="{[URL::to('empresa/'.$empresa_id.'/visiblelogin')]}       ">Back to login</a>
	</div>
</body>