<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>
			All registered Enderecobase
		</h1>
		Data for enderecobases located at
		<ul>
			<li>
				Bairro: {[$bairro->nome]}
			</li>
			<li>
				Cidade: {[$bairro->cidade->nome]}
			</li>
			<li>
				Estado: {[$bairro->cidade->estado->nome]}
			</li>
		</ul>
		<a href="{[URL::to('estado/'.$estado_id.'/cidade/'.$cidade_id.'/bairro/'.$bairro_id.'/enderecobase/create')]}" class=''>Add a new "enderecobase"</a>
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
			@foreach($enderecobase as $e)
			<tr>
				<td>
					<a href="{[URL::to('estado/'.$estado_id.'/cidade/'.$cidade_id.'/bairro/'.$bairro_id.'/showvisibleenderecobase/'.$e->id)]}">HTLM enderecobase {[$e->id]}</a> |
					<a href="{[URL::to('estado/'.$estado_id.'/cidade/'.$cidade_id.'/bairro/'.$bairro_id.'/enderecobase/'.$e->id)]}">JSON enderecobase {[$e->id]}</a>
					<ul>
						<li>
							<a href="{[URL::to('estado/'.$estado_id.'/cidade/'.$cidade_id.'/bairro/'.$bairro_id.'/enderecobase/'.$e->id.'/visibleendereco')]}">HTML endereco for base resource {[$e->id]}</a>
							|
							<a href="{[URL::to('estado/'.$estado_id.'/cidade/'.$cidade_id.'/bairro/'.$bairro_id.'/enderecobase/'.$e->id.'/endereco')]}">JSON endereco for base resource {[$e->id]}</a></li>
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
