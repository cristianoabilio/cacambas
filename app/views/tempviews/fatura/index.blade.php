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
		 	<tr>
		 		<th>resource</th>
		 	@foreach($header as $h)
				@if($h[1]==1)
					<th>
						{[$h[0]  ]}
					</th>
				@endif
			@endforeach
			</tr>

			@foreach($fatura as $e)
				<tr>
					<td>
						<a href="{[URL::to('showvisiblefatura/'.$e->id)]}">HTML resource {[$e->id]} </a>
						|
						<a href="{[URL::to('fatura/'.$e->id)]}">JSON resource {[$e->id]}</a>
					</td>
					@foreach($header as $h)
						@if($h[1]==1)
							<td>
								{[$e->$h[0]  ]}
							</td>
						@endif
					@endforeach
				</tr>
			@endforeach
		</table>
	</div>
</body>

