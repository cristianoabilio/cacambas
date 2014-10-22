<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>
			Data for empresa {[Empresa::find($id)->nome]}
		</h1>
		@foreach($header as $h)
			<div class="row">
				<div class="col-sm-2">{[$h[0] ]}</div>
				<div class="col-sm-6">{[$empresa->$h[0]   ]}</div>
			</div>
		@endforeach
		<a href="{[URL::to('empresa/'.$id.'/edit')]} "> ....  Edit .... </a>
		<br>
		{[ Form::model($empresa, 
			array(
			'route' => array('empresa.destroy', 
			$empresa->id
			)
			, 'method' => 'DELETE')) ]}
			<input type="submit" value='DELETE'>
			</form>
			<br>
		<a href="{[URL::to('empresa')]}       ">Back to empresas</a>
	</div>
</body>
