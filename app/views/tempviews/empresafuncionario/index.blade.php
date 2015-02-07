<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>
			Index for funcionario related to empresa number {[$empresa_id]}
		</h1>
		<a href="{[URL::to('empresa/'.$empresa_id.'/funcionario/create')]}">Add new "funcionario"</a>
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
			@foreach($funcionario as $e)

				@if($e->status==1)
					<tr>
						@foreach($header as $h)
							@if($h[1]==1)
								<td>
									@if($h[0]=='nome')
									<a href="{[URL::to('empresa/'.$empresa_id.'/showvisiblefuncionario/'.$e->id)]}">HTML {[$e->$h[0]  ]}</a> |
									<a href="{[URL::to('empresa/'.$empresa_id.'/funcionario/'.$e->id)]}">JSON {[$e->$h[0]  ]}</a>
									<ul>
										<li>
											<a href="{[URL::to('empresa/'.$empresa_id.'/funcionario/'.$e->id.'/visibleresumoatividade')]}">HTML resumoatividade</a>
											|
											<a href="{[URL::to('empresa/'.$empresa_id.'/funcionario/'.$e->id.'/resumoatividade')]}">JSON resumoatividade</a>
										</li>
										<li>
											<a href="{[URL::to('empresa/'.$empresa_id.'/funcionario/'.$e->id.'/geolocalizacao')]}">JSON Geolocaliza&ccedil;&atilde;o</a>
										</li>
									</ul>
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
		<hr>
		<br>
		deleted (status=0)
		<table class='table'>
			<!-- $h var comes from controller, containing
			the header names on table -->
			@foreach($header as $h)
				@if($h[1]==1)
					<th>
						{[$h[0]  ]}
					</th>
				@endif
			@endforeach

			@foreach($funcionario as $e)
				@if($e->status==0)
					<tr>
						@foreach($header as $h)
							@if($h[1]==1)
								<td>
									@if($h[0]=='nome')
									<a href="{[URL::to('funcionario/'.$e->id)]}">{[$e->$h[0]  ]}</a>
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
	</div>
</body>
		