<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Edit endereco record number {[$endereco->id]}</h1>
		{[ Form::model($endereco, array('route' => array('endereco.update', $endereco->id), 'method' => 'PUT')) ]}
			@foreach($header as $h)
				<div class="row">
					<div class="col-sm-2">
						{[$h[1] ]}
						<br>
						@if($h[0]=='endereco')
						<input type="text" class='form-control' name="{[$h[1] ]}" id="{[$h[1] ]}" value="{[$endereco->enderecobase->endereco->first()->$h[1]   ]}">
						@elseif( $h[0]=='enderecobase')
						<input type="text" class='form-control' name="{[$h[1] ]}" id="{[$h[1] ]}" value="{[$endereco->enderecobase->$h[1]   ]}">
						@elseif( $h[0]=='enderecoempresa' )
						<input type="text" class='form-control' name="{[$h[1] ]}" id="{[$h[1] ]}" value="{[$endereco->$h[1]   ]}">
						@endif
						<br>
					</div>
				</div>
			@endforeach
			<br>
			<input type="submit" value='SAVE CHANGES'>
		{[Form::close()]}
		<br>
		{[ Form::model($endereco, array('route' => array('endereco.destroy', $endereco->id), 'method' => 'DELETE')) ]}
			<input type="submit" value='DELETE'>
		{[Form::close()]}
	</div>
</body>	