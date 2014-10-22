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
				<th>Invoices</th>
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
					<td>
						<a href="{[URL::to('empresa/'.$empresa_id.'/convenio/'.$e->id.'/fatura')]} ">
							faturas
							(total {[Fatura::whereConvenio_id($e->id)->count() ]}  )
						</a>
					</td>
				</tr>
			@endforeach
		</table>
	</div>
</body>
