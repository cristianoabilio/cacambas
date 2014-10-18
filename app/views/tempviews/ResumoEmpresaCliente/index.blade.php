<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Resumoempresacliente index for all companies (empresas) </h1>
		<a href="{[URL::to('resumoempresacliente/create')]}"  class='hide'>Add new "resumoempresacliente"</a>
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
			<th>HTML view</th>

			@foreach($resumoempresacliente as $e)
				<tr>
					@foreach($header as $h)
						@if($h[1]==1)
							<td>
								@if($h[0]=='cliente_id')
								<a href="{[URL::to('resumoempresacliente/'.$e->id)]}">see {[$e->$h[0]  ]} resource as JSON</a>
								@else
								{[$e->$h[0]  ]}
								@endif
								
							</td>
						@endif
						
					@endforeach
					<td><a href="{[URL::to('showvisibleresumoempresacliente/'.$e->id)]}"> see as html</a></td>
				</tr>
			@endforeach
		</table>
	</div>
</body>
		

		