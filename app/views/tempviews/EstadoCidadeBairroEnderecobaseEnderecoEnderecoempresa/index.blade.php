<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>
			All registered Enderecoempresa
		</h1>
		<a href="{[URL::to('estado/'.$estado_id.'/cidade/'.$cidade_id.'/bairro/'.$bairro_id.'/enderecobase/'.$enderecobase_id.'/endereco/'.$endereco_id.'/enderecoempresa/create')]}" class=''>Add new "endereco"</a>
		<br>
		<table class='table'>
			<tr>
				<th>
					Resource
				</th>
			@foreach($header as $h)
				@if($h[1]==1)
					<td> 
						@if($h[0]=='empresa_id')
						Empresa nome
						@else 
						{[$h[0] ]} 
						@endif 
					</td>
				@endif
					
				
			@endforeach
			</tr>
			@foreach($enderecoempresa as $e)
			<tr>
				<td>
					<a href="{[URL::to('estado/'.$estado_id.'/cidade/'.$cidade_id.'/bairro/'.$bairro_id.'/enderecobase/'.$enderecobase_id.'/endereco/'.$endereco_id.'/showvisibleenderecoempresa/'.$e->id)]}">HTLM enderecoempresa {[$e->id]}</a> |
					<a href="{[URL::to('estado/'.$estado_id.'/cidade/'.$cidade_id.'/bairro/'.$bairro_id.'/enderecobase/'.$enderecobase_id.'/endereco/'.$endereco_id.'/enderecoempresa/'.$e->id)]}">JSON enderecoempresa {[$e->id]}</a>
				</td>
				@foreach($header as $h)
					@if($h[1]==1)
						<td>
							@if($h[0]=='empresa_id')
							{[$e->empresa->nome]}
							@else 
							{[$e->$h[0] ]}
							@endif
						</td>
					@endif
				@endforeach
			</tr>	
			@endforeach
		</table>
	</div>
</body>