<?php 
$fake=new fakeuser;
?>
<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Index on resumofinanciero for empresa {[Empresa::find($fake->empresa())->nome ]}</h1>
		<a href="{[URL::to('resumofinanceiro/create')]}">Add new "resumofinanceiro"</a>
		<br>
		<table class='table'>
			<!-- $h var comes from controller Empresa2, containing
			the header names on table Empresa -->
			@foreach($header as $h)
				@if($h[1]==1)
					<th>
						{[$h[0]  ]}
					</th>
				@endif
			@endforeach

			@foreach($resumofinanceiro as $e)
				<tr>
					@foreach($header as $h)
						@if($h[1]==1)
							<td>
								@if($h[0]=='mes_referencia')
								<a href="{[URL::to('resumofinanceiro/'.$e->id)]}">{[$e->$h[0]  ]}</a>
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
		

		