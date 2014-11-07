<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>empresaclienteanotacoes index</h1>
		<a href="{[URL::to('empresaclienteanotacoes/create')]}">Add new "empresaclienteanotacoes"</a>
		<br>
		<table class='table'>
			<tr>
				<th>resource</th>
			<!-- $h var comes from controller Empresa2, containing
			the header names on table Empresa -->
			@foreach($header as $h)
				@if($h[1]==1)
					<th>
						{[$h[0]  ]}
					</th>
				@endif
			@endforeach
			</tr>

			@foreach($empresaClienteAnotacoes as $e)
				<tr>
					<td>
						<a href="{[URL::to('showvisibleempresaclienteanotacoes/'.$e->id)]}">HTML resource</a>
						|
						<a href="{[URL::to('empresaclienteanotacoes/'.$e->id)]}">JSON resource</a>
					</td>
					@foreach($header as $h)
						@if($h[1]==1)
							<td>{[$e->$h[0] ]}</td>
						@endif
					@endforeach
				</tr>
			@endforeach
		</table>
		<br>
		<br>
		<br>
		<h1>Deleted "empresaclienteanotacoes" (status as 0) </h1>
		<table class='table'>
			<tr>
				<th>resource</th>
			<!-- $h var comes from controller Empresa2, containing
			the header names on table Empresa -->
			@foreach($header as $h)
				@if($h[1]==1)
					<th>
						{[$h[0]  ]}
					</th>
				@endif
			@endforeach
			<th>Action</th>
			</tr>

			@foreach($deleted as $e)
				<tr>
					<td>
						<a href="{[URL::to('showvisibleempresaclienteanotacoes/'.$e->id)]}">HTML resource</a>
						|
						<a href="{[URL::to('empresaclienteanotacoes/'.$e->id)]}">JSON resource</a>
					</td>
					@foreach($header as $h)
						@if($h[1]==1)
							<td>{[$e->$h[0] ]}</td>
						@endif
					@endforeach
					<td>
						{[Form::open(array('url'=> URL::to('showvisibleempresaclienteanotacoes/'.$e->id)  ))]}
						
						<input type="submit" value='restore' class='btn btn-link'>
						{[Form::close()]}
					</td>
				</tr>
			@endforeach
		</table>
	</div>
</body>