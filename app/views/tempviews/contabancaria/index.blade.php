<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Contabancaria index</h1>
		<a href="{[URL::to('contabancaria/create')]}">Add new "contabancaria"</a>
		<br>
		<table class='table'>
			<tr>
				<th>
					Resource
				</th>
			@foreach($header as $h)
				@if($h[1]==1)
					<th>
						{[$h[0]  ]}
					</th>
				@endif
			@endforeach
			</tr>
			@foreach($conta as $e)
				<tr>
					<td>
						<a href="{[URL::to('showvisiblecontabancaria/'.$e->id)]}">HTLM resource {[$e->id]}</a>
						|
						<a href="{[URL::to('contabancaria/'.$e->id)]}">JSON resource {[$e->id]}</a>
					</td>
					@foreach($header as $h)
						@if($h[1]==1)
							<td> {[$e->$h[0] ]} </td>
						@endif
					@endforeach
				</tr>
			@endforeach
		</table>
	</div>
</body>

