<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>anotacoes index</h1>
		<a href="{[URL::to('empresa/'.$empresa_id.'/login/'.$login_id.'/anotacoes/create')]}">Add new anotacoe resource</a>
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
						<th>{[$h[0]  ]}</th>
					@endif
				@endforeach
			</tr>
			@foreach($anotacoes as $e)
				<tr>
					<td>
						<a href="{[URL::to('empresa/'.$empresa_id.'/login/'.$login_id.'/showvisibleanotacoes/'.$e['id'] )]}">HTML resource number {[$e['id'] ]} </a>
						|
						<a href="{[URL::to('empresa/'.$empresa_id.'/login/'.$login_id.'/anotacoes/'.$e['id']) ]}">JSON resource number {[$e['id'] ]} </a>
					</td>
					@foreach($header as $h)
						@if($h[1]==1)
							<td>{[  $e[ $h[0] ]   ]}</td>
						@endif
					@endforeach
				</tr>
			@endforeach
		</table>
	</div>
</body>
