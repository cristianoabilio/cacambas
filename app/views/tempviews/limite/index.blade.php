<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Limite index</h1>
		<div class="text-danger">Warning: creation, edition and destruction can only be performed from "plano" and "convenio" views</div>
		<table class='table'>
			<!-- $h var comes from controller limite, containing
			the header names on table limite -->
			<th>Plano or convenio</th>
			@foreach($header as $h)
				@if($h[1]==1)
					<th>
						{[$h[0]  ]}
					</th>
				@endif
			@endforeach

			@foreach($limite as $e)
				<tr>
					<td>
						@if(isset($e->plano->nome))
							{[$e->plano->nome]}
						@elseif(isset($e->convenio->id))
							{[$e->convenio->empresa->nome]}
						@endif
					</td>
					@foreach($header as $h)
						@if($h[1]==1)
							<td>
								@if($h[0]=='motoristas')
								<a href="{[URL::to('limite/'.$e->id)]}">{[$e->$h[0]  ]}</a>
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
<br>
<br>

