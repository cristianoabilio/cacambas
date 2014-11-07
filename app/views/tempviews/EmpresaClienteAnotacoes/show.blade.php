<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>
			Resource id {[$EmpresaClienteAnotacoes->id]}
		</h1>
		@foreach($header as $h)
			<div class="row">
				<div class="col-sm-2">{[$h[0] ]}</div>
				<div class="col-sm-6">{[$EmpresaClienteAnotacoes->$h[0]   ]}</div>
			</div>
		@endforeach
		<a href="{[URL::to('empresaclienteanotacoes/'.$id.'/edit')]} "> ....  Edit .... </a>
		<br>
		{[ Form::model($EmpresaClienteAnotacoes, 
			array(
			'route' => array('empresaclienteanotacoes.destroy', 
			$id
			)
			, 'method' => 'DELETE')) ]}
			<input type="submit" value='DELETE'>
			{[Form::close()]}
			<br>
		<a href="{[URL::to('visibleempresaclienteanotacoes')]}       ">Back to empresaClienteAnotacoes index</a>
	</div>
</body>
