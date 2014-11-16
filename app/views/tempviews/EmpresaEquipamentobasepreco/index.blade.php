<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>
			Index for equipamentobasepreco resource related to empresa number {[$empresa_id]}
		</h1>
		<a href="{[URL::to('empresa/'.$empresa_id.'/equipamentobasepreco/create')]}">Add new equipamentobasepreco resource</a>
		<br>
		<table class='table'>
			<!-- $h var comes from controller, containing
			the header names on table  -->
			<tr>
				<th>
					resource
				</th>
				@foreach($header as $h)
					@if($h[1]==1)
						<th>
							{[$h[0]  ]}
						</th>
					@endif
				@endforeach
			</tr>
			@foreach($equipamentobasepreco as $e)

				@if($e->status==1)
					<tr>
						<td>
							<a href="{[URL::to('empresa/'.$empresa_id.'/showvisibleequipamentobasepreco/'.$e->id)]}">HTML resource number {[$e->id]} </a>
							|
							<a href="{[URL::to('empresa/'.$empresa_id.'/equipamentobasepreco/'.$e->id)]}">JSON resource number {[$e->id]} </a>
						</td>
						@foreach($header as $h)
							@if($h[1]==1)
								<td>{[$e->$h[0]  ]}</td>
							@endif
						@endforeach
					</tr>
				@endif
			@endforeach
		</table>
		<br>
	</div>
</body>
		