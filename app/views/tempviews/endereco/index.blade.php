<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>
			All registered Endereco
		</h1>
		<a href="{[URL::to('endereco/create')]}" class='hide'>Add new "endereco"</a>
		<br>
		<table class='table'>
			<tr>
				<th>
					Resource
				</th>
			@foreach($header as $h)
				@if($h[1]==1)
					<td> {[$h[0] ]}  </td>
				@endif
			@endforeach
			</tr>
			@foreach($endereco as $e)
			<tr>
				<td>
					<a href="{[URL::to('showvisibleendereco/'.$e->id)]}">HTLM endereco {[$e->id]}</a> |
					<a href="{[URL::to('endereco/'.$e->id)]}">JSON endereco {[$e->id]}</a>
				</td>
				@foreach($header as $h)
					@if($h[1]==1)
						<td>
							{[$e->$h[0] ]}
						</td>
					@endif
				@endforeach
			</tr>	
			@endforeach
		</table>
	</div>
</body>