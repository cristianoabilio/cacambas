<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Index for all plans "plano"</h1>
		<div>
			<a href="{[URL::to('plano/create')]}">Add new "plano"</a>
		</div>
		<br><br>
		<table class='table'>
			<!-- $h var comes from controller plano, containing
			the header names on table plano -->
			@foreach($header as $h)
				@if($h[1]==1)
					<th>
						{[$h[0]  ]}
					</th>
				@endif
			@endforeach

			@foreach($plano as $e)
				<tr>
					@foreach($header as $h)
						@if($h[1]==1)
							<td>
								@if($h[0]=='nome')
								<a href="{[URL::to('plano/'.$e->id)]}">{[$e->$h[0]  ]}</a>
								@else
								{[$e->$h[0]  ]}
								@endif
								
							</td>
						@endif
					@endforeach
				</tr>
			@endforeach
		</table>
		<hr>
		<h3 class="text-muted">Inactive plans (plano status 0)</h3>
		<table class='table'>
			<!-- $h var comes from controller plano, containing
			the header names on table plano -->
			@foreach($header as $h)
				@if($h[1]==1)
					<th>
						{[$h[0]  ]}
					</th>
				@endif
			@endforeach

			@foreach($deleted as $e)
				<tr>
					@foreach($header as $h)
						@if($h[1]==1)
							<td>
								@if($h[0]=='nome')
								<a href="{[URL::to('plano/'.$e->id)]}">{[$e->$h[0]  ]}</a>
								@else
								{[$e->$h[0]  ]}
								@endif
								
							</td>
						@endif
					@endforeach
				</tr>
			@endforeach
		</table>
	</div>
</body>
<br>
<br>

		