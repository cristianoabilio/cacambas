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

				@if($e->status==1)
					<tr>
						<td>
							<a href="{[URL::to('empresa/'.$empresa_id.'/showvisiblelogin/'.$e->id)]}">HTML resource {[$e->id  ]}</a>
							|
							<a href="{[URL::to('empresa/'.$empresa_id.'/login/'.$e->id)]}">JSON {[$e->id  ]}</a>
							<ul>
								@foreach($nested as $n)
									<li>
										<a href="{[URL::to('empresa/'.$empresa_id.'/login/'.$e->id.'/visible'.$n)]}">HTML {[$n]}</a>
										|

										<a href="{[URL::to('empresa/'.$empresa_id.'/login/'.$e->id.'/'.$n)]}">JSON {[$n]}</a>
										
									</li>
								@endforeach
							</ul>
						</td>
						@foreach($header as $h)
							@if($h[1]==1)
								<td> {[$e->$h[0]  ]}</td>
							@endif
						@endforeach
					</tr>
				@endif
			@endforeach
		</table>
		<br>
	</div>
</body>
		