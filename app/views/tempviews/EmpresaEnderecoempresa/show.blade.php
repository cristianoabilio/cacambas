<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Data for endereco record {[$id]} </h1>
		@foreach($header as $h)
			<div class="row">
				<div class="col-sm-2">{[$h[1] ]}</div>
				<div class="col-sm-6">
					@if($h[0]=='endereco')
						{[$endereco->enderecobase->endereco->first()->$h[1]   ]}
					@elseif( $h[0]=='enderecobase')
						{[$endereco->enderecobase->$h[1]   ]}
					@elseif( $h[0]=='enderecoempresa' )
						{[$endereco->$h[1]   ]}
					@endif
				</div>
			</div>
		@endforeach
		<br>
		<br>
		<br>
		<a href="{[URL::to('endereco/'.$id.'/edit')]} ">
			....  Edit .... 
		</a>
		<br>
		{[ Form::model($endereco, array('route' => array('endereco.destroy', $empresa_id,$id), 'method' => 'DELETE')) ]}
			<input type="submit" value='DELETE'>
		{[Form::close()]}
		<br>
		<a href="{[URL::to('empresa/'.$id.'/visibleenderecoempresa') ]}">Back to enderecoempresa index</a>
	</div>
</body>	