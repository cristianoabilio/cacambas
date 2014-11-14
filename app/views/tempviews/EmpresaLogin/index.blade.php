<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>
			Index for login resource (user) related to empresa number {[$empresa_id]}
		</h1>
		<a href="{[URL::to('empresa/'.$empresa_id.'/login/create')]}">Add new user (login record)</a>
		<br>
		<table class='table'>
			<!-- $h var comes from controller, containing
			the header names on table  -->
			<tr>
			@foreach($header as $h)
				@if($h[1]==1)
					<th>
						{[$h[0]  ]}
					</th>
				@endif
			@endforeach
			</tr>
			@foreach($login as $e)

				@if($e->status==1)
					<tr>
						@foreach($header as $h)
							@if($h[1]==1)
								<td>
									@if($h[0]=='nome')
									<a href="{[URL::to('empresa/'.$empresa_id.'/showvisiblelogin/'.$e->id)]}">HTML {[$e->$h[0]  ]}</a> |
									<a href="{[URL::to('empresa/'.$empresa_id.'/login/'.$e->id)]}">JSON {[$e->$h[0]  ]}</a>
									@else
									{[$e->$h[0]  ]}
									@endif
									
								</td>
							@endif
						@endforeach
					</tr>
				@endif
			@endforeach
		</table>
		<br>
	</div>
</body>
		