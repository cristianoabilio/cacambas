
<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>
			All registered Equipamentobasepreco
		</h1>
		<a href="{[URL::to('equipamentobasepreco/create')]}" class=''>Add new "equipamentobasepreco"</a>
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
			@foreach($equipamentobasepreco as $e)
			<tr>
				<td>
					<a href="{[URL::to('showvisibleequipamentobasepreco/'.$e->id)]}">HTLM equipamentobasepreco {[$e->id]}</a> |
					<a href="{[URL::to('equipamentobasepreco/'.$e->id)]}">JSON equipamentobasepreco {[$e->id]}</a>
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
