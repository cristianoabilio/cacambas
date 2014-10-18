<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Funcionario number {[$id]} </h1>
		@foreach($header as $h)
		<div class="row">
			<div class="col-sm-2">{[$h[0] ]}</div>
			<div class="col-sm-6">{[$funcionario->$h[0]   ]}</div>
		</div>
		@endforeach
		<a href="{[URL::to('empresa/'.$empresa_id.'/funcionario/'.$id.'/edit')]} "> ....  Edit .... </a>
		<br>
		{[ Form::model($funcionario, array('route' => array('funcionario.destroy', $funcionario->id), 'method' => 'DELETE')) ]}
		<input type='submit' value='delete'>
		{[Form::close()]}
		<br>
		<a href="{[URL::to('empresa/'.$empresa_id.'/visiblefuncionario')]}       ">Back to funcionario</a>
	</div>
</body>