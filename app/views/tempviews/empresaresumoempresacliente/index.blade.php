<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Resumoempresacliente index for empresa 
		{[Empresa::find($empresa_id)->nome ]}</h1>
		<a href="{[URL::to('empresa/'.$empresa_id.'/resumoempresacliente/create')]}">Add new "resumoempresacliente"</a>
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
			<th>html show</th>

			@foreach($resumoempresacliente as $e)
				<tr>
					@foreach($header as $h)
						@if($h[1]==1)
							<td>
								@if($h[0]=='cliente_id')
								<a href="{[URL::to('empresa/'.$empresa_id.'/resumoempresacliente/'.$e->id)]}">JSON data: {[$e->$h[0]  ]}</a>
								@else
								{[$e->$h[0]  ]}
								@endif
								
							</td>
						@endif
					
					@endforeach
					<td>
						<a href="{[URL::to('empresa/'.$empresa_id.'/showvisibleresumoempresacliente/'.$e->id)]}">HTML view  {[$e->id]}</a>
					</td>
				</tr>
			@endforeach
		</table>
	</div>
</body>