<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>
			All registered Equipamento
		</h1>
		<a href="{[URL::to('equipamento/create')]}" class=''>Add new "equipamento"</a>
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
			@foreach($equipamento as $e)
			<tr>
				<td>
					<a href="{[URL::to('showvisibleequipamento/'.$e->id)]}">HTLM equipamento {[$e->id]}</a> |
					<a href="{[URL::to('equipamento/'.$e->id)]}">JSON equipamento {[$e->id]}</a>
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
