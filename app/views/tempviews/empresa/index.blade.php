<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Empresa index</h1>
		<a href="{[URL::to('empresa/create')]}">Add new "empresa"</a>
		<br>
		<table class='table'>
			<!-- $h var comes from controller Empresa2, containing
			the header names on table Empresa -->
			@foreach($header as $h)
				@if($h[1]==1)
					<th>
						{[$h[0]  ]}
					</th>
				@endif
			@endforeach

			@foreach($empresas as $e)
				<tr>
					@foreach($header as $h)
						@if($h[1]==1)
							<td>
								@if($h[0]=='nome')
								<a href="{[URL::to('empresa/'.$e->id)]}">{[$e->$h[0]  ]}</a>
								<ul>
									<li>
										<a href="{[URL::to('empresa/'.$e->id).'/visibleresumoempresacliente']}">HTML resumoempresacliente</a>
										|
										<a href="{[URL::to('empresa/'.$e->id).'/resumoempresacliente']}">JSON Resumoempresacliente</a>
									</li>
								</ul>
								@else
								{[$e->$h[0]  ]}
								@endif
								
							</td>
						@endif
					@endforeach
				</tr>
			@endforeach
		</table>
		<br>
		<br>
		<br>
		<h1>Deleted "Empresas" (status as 0) </h1>
		<table class='table'>
			<!-- $h var comes from controller Empresa2, containing
			the header names on table Empresa -->
			@foreach($header as $h)
				@if($h[1]==1)
					<th>
						{[$h[0]  ]}
					</th>
				@endif
			@endforeach

			@foreach($deleted as $e)
				<tr>
					@foreach($header as $h)
						@if($h[1]==1)
							<td>
								@if($h[0]=='nome')
								<a href="{[URL::to('empresa/'.$e->id)]}">{[$e->$h[0]  ]}</a>
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