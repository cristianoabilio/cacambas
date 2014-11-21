
<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>
			All registered Equipamentodetail
		</h1>
		<a href="{[URL::to('equipamentodetail/create')]}" class=''>Add new "equipamentodetail"</a>
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
			@foreach($equipamentodetail as $e)
			<tr>
				<td>
					<a href="{[URL::to('showvisibleequipamentodetail/'.$e->id)]}">HTLM equipamentodetail {[$e->id]}</a> |
					<a href="{[URL::to('equipamentodetail/'.$e->id)]}">JSON equipamentodetail {[$e->id]}</a>
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
