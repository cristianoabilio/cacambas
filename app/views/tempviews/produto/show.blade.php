<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Data for produto {[$produto->nome]} </h1>
		@foreach($header as $h)
			<div class="row">
				<div class="col-sm-2">{[$h[0] ]}</div>
				<div class="col-sm-6">{[$produto->$h[0]   ]}</div>
			</div>
		@endforeach
		<br>
		<br>
		<br>

		<a href="{[URL::to('produto/'.$id.'/edit')]} "> ....  Edit .... </a>
		<br>
		{[ Form::model($produto, array('route' => array('produto.destroy', $produto->id), 'method' => 'DELETE')) ]}
			<input type="submit" value='DELETE'>
			</form>
			<br>
		<a href="{[URL::to('visibleproduto')]}">Back to produto</a>
	</div>
</body>