<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<?php 
$fake=new fakeuser;
 ?>
<body>
	<div class="container">
		<h1>
			{[Empresa::find($fake->empresa())->nome ]}
		</h1>
		<a href="{[URL::to('compras/create')]}">Add new "compra"</a>
		<br>
		<table>
			<!-- $h var comes from controller Empresa2, containing
			the header names on table Empresa -->
			@foreach($header as $h)
				@if($h[1]==1)
					<th>
						{[$h[0]  ]}
					</th>
				@endif
			@endforeach

			@foreach($compras as $e)
				<tr>
					@foreach($header as $h)
						@if($h[1]==1)
							<td>
								@if($h[0]=='produto_id')
								<a href="{[URL::to('compras/'.$e->id)]}">{[$e->$h[0]  ]}</a>
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


		