<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Index for produto</h1>
		<br>
		<a href="{[URL::to('produto/create')]}">Add new "produto"</a>
		<br>
		<table class='table'>
			<tr>
				<th>Resource</th>
			<!-- $h var comes from controller produto, containing
			the header names on table produto -->
			@foreach($header as $h)
				@if($h[1]==1)
					<th>
						{[$h[0]  ]}
					</th>
				@endif
			@endforeach
			</tr>

			@foreach($produto as $e)
				<tr>
					<td>
						<a href="{[URL::to('showvisibleproduto/'.$e->id)]}">HTML resource {[$e->id]}</a>
						|
						<a href="{[URL::to('produto/'.$e->id)]}">JSON resource {[$e->id]}</a>
					</td>
					@foreach($header as $h)
						@if($h[1]==1)
							<td>{[$e->$h[0]  ]}</td>
						@endif
					@endforeach
				</tr>
			@endforeach
		</table>
		<h1>Deleted products</h1>

		<table class='table'>
			<tr>
				<th>Resource</th>
			<!-- $h var comes from controller produto, containing
			the header names on table produto -->
			@foreach($header as $h)
				@if($h[1]==1)
					<th>
						{[$h[0]  ]}
					</th>
				@endif
			@endforeach
			<th>action</th>
			</tr>
			@foreach($deleted as $e)
				<tr>
					<td>
						<a href="{[URL::to('showvisibleproduto/'.$e->id)]}">HTML resource {[$e->id]}</a>
						|
						<a href="{[URL::to('produto/'.$e->id)]}">JSON resource {[$e->id]}</a>
					</td>
					@foreach($header as $h)
						@if($h[1]==1)
							<td>{[$e->$h[0]  ]}</td>
						@endif
					@endforeach
					<td>
						{[Form::open(array('url'=>URL::to('showvisibleproduto/'.$e->id)))]}
						<input type="submit" value='restore' class='btn btn-link'>
						{[Form::close()]}
					</td>
				</tr>
			@endforeach
		</table>
	</div>
</body>
		