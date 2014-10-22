<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Contabancaria resource number {[$id]}</h1>
		@foreach($header as $h)
		<div class="row">
			<div class="col-sm-2">{[$h[0] ]}</div>
			<div class="col-sm-6">{[$contabancaria->$h[0]   ]}</div>
		</div>
		@endforeach
		<a href="{[URL::to('empresa/'.$empresa_id.'/contabancaria/'.$id.'/edit')]} "> ....  Edit .... </a>
		<br>
		{[ Form::model($contabancaria, array('route' => array('empresa.contabancaria.destroy', $empresa_id,$id), 'method' => 'DELETE')) ]}
			<input type="submit" value='DELETE'>
			</form>
			<br>
		<a href="{[URL::to('empresa/'.$empresa_id.'/visiblecontabancaria')]}">Return to contabancaria index</a>
		<br>
		<br>
		<br>
	</div>
</body>