<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Index on resumofinanciero for all companies (empresa) </h1>
		<a 
		class='hide'
		href="{[URL::to('resumofinanceiro/create')]}">Add new "resumofinanceiro"</a>
		<br>
		<table class='table'>
			<tr>
				<th>resource id</th>
				@foreach($header as $h)
					@if($h[1]==1)
						<th>
							{[$h[0]  ]}
						</th>
					@endif
				@endforeach
			</tr>

			@foreach($resumofinanceiro as $e)
				<tr>
					<td>
						<a href="{[URL::to('showvisibleresumofinanceiro/'.$e->id)]}">
							HTML for {[$e->id]}
						</a> |
						<a href="{[URL::to('resumofinanceiro/'.$e->id)]}">
							JSON for {[$e->id]}
						</a> |
					</td>
					@foreach($header as $h)
						@if($h[1]==1)
							<td>{[$e->$h[0]  ]}</td>
						@endif
					@endforeach
				</tr>
			@endforeach
		</table>
	</div>
</body>
		

		