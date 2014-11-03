<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Data for enderecoempresa record {[$id]} </h1>
		data related to 
		<ul>
			<li>Endereco: {[$endereco->cep]}</li>
			<li>
				Enderecobase: {[$endereco->enderecobase->cep_base]}
			</li>
			<li>
				Bairro: {[$endereco->enderecobase->bairro->nome]}
			</li>
			<li>
				Cidade: {[$endereco->enderecobase->bairro->cidade->nome]}
			</li>
			<li>
				Estado: {[$endereco->enderecobase->bairro->cidade->estado->nome]}
			</li>
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
		<a href="{[URL::to('estado/'.$estado_id.'/cidade/'.$cidade_id.'/bairro/'.$bairro_id.'/enderecobase/'.$enderecobase_id.'/endereco/'.$endereco_id.'/enderecoempresa/'.$id.'/edit')]} ">
			....  Edit .... 
		</a>
		<br>
		<br>
		<a href="{[URL::to('estado/'.$estado_id.'/cidade/'.$cidade_id.'/bairro/'.$bairro_id.'/enderecobase/'.$enderecobase_id.'/endereco/'.$endereco_id.'/visibleenderecoempresa') ]}">Back to enderecoempresa index</a>
		<br>
		<br>
		<br>
	</div>
</body>	