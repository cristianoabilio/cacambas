<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<bocy>
	<div class="container">
		<h1>compra register number {[$compras->id]} </h1>
		@foreach($header as $h)
		<div class="row">
			<div class="col-sm-2">{[$h[0] ]}</div>
			<div class="col-sm-6">{[$compras->$h[0]   ]}</div>
		</div>
		@endforeach
		<br>
		<br>
		<a href="{[URL::to('compras/'.$id.'/edit')]} "> ....  Edit .... </a>
		<br>
		{[ Form::model($compras, 
			array(
			'route' => array('compras.destroy', 
			$compras->id
			)
			, 'method' => 'DELETE')) ]}
			<input type="submit" value='DELETE'>
			</form>
			<br>
		<a href="{[URL::to('compras')]}       ">Back to compras</a>
	</div>
</bocy>
		
<br>


		