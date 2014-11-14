<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Index for all plans "perfil"</h1>
		<div>
			<a href="{[URL::to('perfil/create')]}">Add new "perfil"</a>
		</div>
		<br><br>
		<table class='table'>
			<!-- $h var comes from controller perfil, containing
			the header names on table perfil -->
			<tr>
				<th>Resource</th>
				@foreach($header as $h)
				
				
					@if($h[1]==1)
						<th>
							{[$h[0]  ]}
						</th>
					@endif
				@endforeach
			</tr>

			@foreach($perfil as $e)
				<tr>
					<td>
						<a href="{[URL::to('showvisibleperfil/'.$e->id)]}">HTML resource numbe {[$e->id]}</a>
						|
						<a href="{[URL::to('perfil/'.$e->id)]}">JSON resource number {[$e->id]}</a>
					</td>
					
					@foreach($header as $h)
						@if($h[1]==1)
							<td>{[$e->$h[0]  ]}</td>
						@endif
					@endforeach
				</tr>
			@endforeach
		</table>
		<hr>
		<h3 class="text-muted">Inactive plans (perfil status 0)</h3>
		<table class='table'>
			<!-- $h var comes from controller perfil, containing
			the header names on table perfil -->
			<tr>
				<th>Resource</th>
				@foreach($header as $h)
				
				
					@if($h[1]==1)
						<th>
							{[$h[0]  ]}
						</th>
					@endif
				@endforeach
			</tr>

			@foreach($deleted as $e)
				<tr>
					<td>
						<a href="{[URL::to('showvisibleperfil/'.$e->id)]}">HTML resource numbe {[$e->id]}</a>
						|
						<a href="{[URL::to('perfil/'.$e->id)]}">JSON resource number {[$e->id]}</a>
					</td>
					
					@foreach($header as $h)
						@if($h[1]==1)
							<td>{[$e->$h[0]  ]}</td>
						@endif
					@endforeach
				</tr>
			@endforeach
		</table>
	</div>
</body>
<br>
<br>

		