<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Edit endereco record number {[$enderecoempresa->id]}</h1>
		{[ Form::model($enderecoempresa, array('route' => array('empresa.enderecoempresa.update', $empresa_id,$id), 'method' => 'PUT')) ]}
			@foreach($header as $h)
				<div class="row">
					<div class="col-sm-2">
						{[$h[1] ]}
						<br>
						@if($h[0]=='endereco')
						<input type="text" class='form-control' name="{[$h[1] ]}" id="{[$h[1] ]}" value="{[$enderecoempresa->enderecobase->endereco->first()->$h[1]   ]}">
						@elseif( $h[0]=='enderecobase')
						<input type="text" class='form-control' name="{[$h[1] ]}" id="{[$h[1] ]}" value="{[$enderecoempresa->enderecobase->$h[1]   ]}">
						@elseif( $h[0]=='enderecoempresa' )
						<input type="text" class='form-control' name="{[$h[1] ]}" id="{[$h[1] ]}" value="{[$enderecoempresa->$h[1]   ]}">
						@endif
						<br>
					</div>
				</div>
			@endforeach
			<br>
			<input type="submit" value='SAVE CHANGES'>
		{[Form::close()]}
		<br>
		{[ Form::model($enderecoempresa, array('route' => array('empresa.enderecoempresa.destroy', $empresa_id,$id), 'method' => 'DELETE')) ]}
			<input type="submit" value='DELETE'>
		{[Form::close()]}
		<br>
		<a href="{[URL::to('empresa/'.$id.'/visibleenderecoempresa') ]}">Back to enderecoempresa index</a>
		<br>
		<br>
	</div>
</body>	