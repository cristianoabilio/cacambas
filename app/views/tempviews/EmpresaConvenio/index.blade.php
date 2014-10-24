<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>
			Convenios for {[Empresa::find($empresa_id)->nome]}
		</h1>
		<a href="{[URL::to('empresa/'.$empresa_id.'/convenio/create')]}">Add new "convenio" to empresa {[Empresa::find($empresa_id)->nome]}</a>
		<br>
		<br>
		<table class='table'>
			<!-- $h var comes from controller convenio, containing
			the header names on table convenio -->
			<tr>
				<th>
					convenio number
				</th>
				@foreach($header as $h)
					@if($h[1]==1)
						<th>
							{[$h[0]  ]}
						</th>
					@endif
				@endforeach
			</tr>
			@foreach($convenio as $e)
				<tr>
					<td>
						<a href="{[URL::to('empresa/'.$empresa_id.'/showvisibleconvenio/'.$e->id)]}">
							HTML resource {[$e->id]}
						</a>
						|
						<a href="{[URL::to('empresa/'.$empresa_id.'/convenio/'.$e->id)]}">
							JSON resource {[$e->id]}
						</a>
						<ul>
							<li>
								<a href="{[URL::to('empresa/'.$empresa_id.'/convenio/'.$e->id.'/visibleprodutofatura')]} ">
									HTML produto faturas
								</a>
								|
								<a href="{[URL::to('empresa/'.$empresa_id.'/convenio/'.$e->id.'/produtofatura')]} ">
									JSON produto faturas
								</a>
							</li>
							<li>
								<a href="{[URL::to('empresa/'.$empresa_id.'/convenio/'.$e->id.'/visiblefatura')]} ">
								HTML servico fatura {[$e->id]}
								</a>
								|
								<a href="{[URL::to('empresa/'.$empresa_id.'/convenio/'.$e->id.'/fatura')]}">JSON servico fatura {[$e->id]}
								</a>
							</li>
						</ul>
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
