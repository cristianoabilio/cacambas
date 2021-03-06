<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Index for produto</h1>
		<br>
		<a href="{[URL::to('produtocompra/create')]}">Add new "produto"</a>
		<br>
		<table class='table'>
			<!-- $h var comes from controller produto, containing
			the header names on table produto -->
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

			@foreach($produtocompra as $e)
				<tr>
					<td>
						<a href="{[URL::to('showvisibleprodutocompra/'.$e->id)]}">HTML resource {[$e->id]}</a>
						|
						<a href="{[URL::to('produtocompra/'.$e->id)]}">JSON resource {[$e->id]}</a>
					</td>
					@foreach($header as $h)
						@if($h[1]==1)
							<td>{[$e->$h[0] ]}</td>
						@endif
					@endforeach
				</tr>
			@endforeach
		</table>
		
	</div>
</body>
		