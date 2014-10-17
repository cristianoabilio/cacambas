<?php 
$fake=new fakeuser;
 ?>
 <head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>
			{[Empresa::find($fake->empresa())->nome ]}
		</h1>
		<a href="{[URL::to('funcionario/create')]}">Add new "funcionario"</a>
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
				<th>ResumoAtividade</th>
			</tr>
			@foreach($funcionario as $e)

				@if($e->status==1)
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
						<td>
							<a href="{[URL::to('funcionario/'.$e->id.'/resumoatividade')]}">See atividade</a>
						</td>
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
		