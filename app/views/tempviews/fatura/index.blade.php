<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Fatura index</h1>
		<a href="{[URL::to('fatura/create')]}">Add new "fatura"</a>
		<br>
		<table class='table'>
		 	<!-- $h var comes from controller fatura, containing
		 	the header names on table fatura -->
		 	@foreach($header as $h)
				@if($h[1]==1)
					<th>
						{[$h[0]  ]}
					</th>
				@endif
			@endforeach

			@foreach($fatura as $e)
				<tr>
					@foreach($header as $h)
						@if($h[1]==1)
							<td>
								@if($h[0]=='empresa_id')
								<a href="{[URL::to('fatura/'.$e->id)]}">{[$e->$h[0]  ]}</a>
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

