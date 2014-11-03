<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Data for enderecoempresa record {[$id]} </h1>
		data related to
		<ul>
			<li>Empresa: {[ $enderecoempresa->empresa->nome ]}</li>
			<li>Estado: {[ $enderecoempresa->endereco->enderecobase->bairro->cidade->estado->nome ]}</li>
			<li>Cidade: {[ $enderecoempresa->endereco->enderecobase->bairro->cidade->nome ]}</li>
			<li>Bairro: {[ $enderecoempresa->endereco->enderecobase->bairro->nome ]}</li>
			<li>Enderecobase: {[ $enderecoempresa->endereco->enderecobase->cep_base ]}</li>
			<li>Endereco: {[ $enderecoempresa->endereco->cep ]}</li>
		</ul>

		@foreach($header as $h)
			<div class="row">
				<div class="col-sm-2">{[$h[0] ]}</div>
				<div class="col-sm-6">
					{[$enderecoempresa->$h[0] ]}
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
		{[ Form::model($enderecoempresa, array('route' => array('enderecoempresa.destroy', $empresa_id,$id), 'method' => 'DELETE')) ]}
			<input type="submit" value='DELETE'>
		{[Form::close()]}
		<br>
		<a href="{[URL::to('empresa/'.$id.'/visibleenderecoempresa') ]}">Back to enderecoempresa index</a>
	</div>
</body>	