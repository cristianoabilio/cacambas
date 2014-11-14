<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Index for all plans "login"</h1>
		<div>
			<a href="{[URL::to('login/create')]}">Add new "login"</a>
		</div>
		<br><br>
		<table class='table'>
			<!-- $h var comes from controller login, containing
			the header names on table login -->
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

			@foreach($login as $e)
				<tr>
					<td>
						<a href="{[URL::to('showvisiblelogin/'.$e->id)]}">HTML resource numbe {[$e->id]}</a>
						|
						<a href="{[URL::to('login/'.$e->id)]}">JSON resource number {[$e->id]}</a>
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
		
	</div>
</body>
<br>
<br>

		