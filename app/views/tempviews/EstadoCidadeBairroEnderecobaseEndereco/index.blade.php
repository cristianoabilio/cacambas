<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>
			All registered Endereco
		</h1>
		Data for endereco located at
		<ul>
			<li>
				Enderecobase: {[$enderecobase->cep_base]}
			</li>
			<li>
				Bairro: {[$enderecobase->bairro->nome]}
			</li>
			<li>
				Cidade: {[$enderecobase->bairro->cidade->nome]}
			</li>
			<li>
				Estado: {[$enderecobase->bairro->cidade->estado->nome]}
			</li>
		</ul>
		<a href="{[URL::to('estado/'.$estado_id.'/cidade/'.$cidade_id.'/bairro/'.$bairro_id.'/enderecobase/'.$endebase_id.'/endereco/create')]}" class=''>Add a new "endereco" for current base/bairro/cidade/estado</a>
		<br>
		<table class='table'>
			<tr>
				<th>
					Resource
				</th>
			@foreach($header as $h)
				@if($h[1]==1)
					<td> {[$h[0] ]}  </td>
				@endif
			@endforeach
			</tr>
			@foreach($endereco as $e)
			<tr>
				<td>
					<a href="{[URL::to('estado/'.$estado_id.'/cidade/'.$cidade_id.'/bairro/'.$bairro_id.'/enderecobase/'.$endebase_id.'/showvisibleendereco/'.$e->id)]}">HTLM endereco {[$e->id]}</a> |
					<a href="{[URL::to('estado/'.$estado_id.'/cidade/'.$cidade_id.'/bairro/'.$bairro_id.'/enderecobase/'.$endebase_id.'/endereco/'.$e->id)]}">JSON endereco {[$e->id]}</a>
					<ul>
						<li>
							<a href="{[URL::to('estado/'.$estado_id.'/cidade/'.$cidade_id.'/bairro/'.$bairro_id.'/enderecobase/'.$endebase_id.'/endereco/'.$e->id.'/visibleenderecoempresa')]}">HTML enderecobase for bairro resource {[$e->id]}</a>
							|
							<a href="{[URL::to('estado/'.$estado_id.'/cidade/'.$cidade_id.'/bairro/'.$bairro_id.'/enderecobase/'.$endebase_id.'/endereco/'.$e->id.'/enderecoempresa')]}">JSON enderecobase for bairro resource {[$e->id]}</a></li>
						</li>
					</ul>
				</td>
				@foreach($header as $h)
					@if($h[1]==1)
						<td>
							{[$e->$h[0] ]}
						</td>
					@endif
				@endforeach
			</tr>	
			@endforeach
		</table>
	</div>
</body>