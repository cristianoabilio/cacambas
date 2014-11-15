<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>
			All registered Equipamentobase
		</h1>
		<a href="{[URL::to('equipamentobase/create')]}" class='hide'>Add new "equipamentobase"</a>
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
			@foreach($equipamentobase as $e)
			<tr>
				<td>
					<a href="{[URL::to('showvisibleequipamentobase/'.$e->id)]}">HTLM equipamentobase {[$e->id]}</a> |
					<a href="{[URL::to('equipamentobase/'.$e->id)]}">JSON equipamentobase {[$e->id]}</a>
					<br>
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
