<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>
			Produtofatura for {[Empresa::find($empresa_id)->nome]}
		</h1>
		<a href="{[URL::to('empresa/'.$empresa_id.'/convenio/'.$convenio_id.'/produtofatura/create')]}">Add new "Produtofatura" to empresa {[Empresa::find($empresa_id)->nome]}</a>
		<br>
		<br>
		<table class='table'>
			<!-- $h var comes from controller convenio, containing
			the header names on table convenio -->
			<tr>
				<th>
					resource number
				</th>
				@foreach($header as $h)
					@if($h[1]==1)
						<th>
							{[$h[0]  ]}
						</th>
					@endif
				@endforeach
			</tr>
			@foreach($produtofatura as $e)
				<tr>
					<td>
						<a href="{[URL::to('empresa/'.$empresa_id.'/convenio/'.$convenio_id.'/showvisibleprodutofatura/'.$e->id)]}">
							HTML resource {[$e->id]}
						</a>
						|
						<a href="{[URL::to('empresa/'.$empresa_id.'/convenio/'.$convenio_id.'/produtofatura/'.$e->id)]}">
							JSON resource {[$e->id]}
						</a>
					</td>
					@foreach($header as $h)
						@if($h[1]==1)
							<td>
								@if($h[0]=='plano_id')
								{[$e->plano->nome  ]}
								@else
								{[$e->$h[0]  ]}
								@endif
							</td>
						@endif
					@endforeach
				</tr>
			@endforeach
		</table>
	</div>
</body>
