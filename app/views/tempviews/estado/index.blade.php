<?php 
$fake=new fakeuser;
?>
<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Estado </h1>
		<a href="{[URL::to('estado/create')]}">
			Add new "estado"
		</a>
		<br>
		<table class='table'>
			<!-- $h var comes from controller , containing
			the header names on table  -->
			<tr>
				<th>
					Register
				</th>
			@foreach($header as $h)
				@if($h[1]==1)
					<th>
						{[$h[0]  ]}
					</th>
				@endif
			@endforeach
			</tr>
			@foreach($estado as $e)
				<tr>
					<td>
						<a href="{[URL::to('estado/'.$e->id)]}">Number {[$e->id]}</a>
						
					</td>
					@foreach($header as $h)
						@if($h[1]==1)
							<td>
								@if($h[0]=='nome')
								<a href="{[URL::to('estado/'.$e->id)]}">{[ $e->$h[0]  ]}</a>
								
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
		