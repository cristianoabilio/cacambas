<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Custo index</h1>
		<a href="{[URL::to('custo/create')]}">Add new "custo"</a>
		<br>
		<table class='table'>
			<tr>
				<th>Resource</th>
			
			<!-- $h var comes from controller Empresa2, containing
			the header names on table Empresa -->
			@foreach($header as $h)
			
				@if($h[1]==1)
					<th>
						{[$h[0]  ]}
					</th>
				@endif
			@endforeach
			</tr>

			@foreach($custo as $e)
				<tr>
					<td>
						<a href="{[URL::to('showvisiblecusto/'.$e->id)]}">HTML resource {[$e->id]}</a>
						|
						<a href="{[URL::to('custo/'.$e->id)]}">JSON resource {[$e->id]}</a>
					</td>
					@foreach($header as $h)
						@if($h[1]==1)
							<td>
								@if($h[0]=='nome')
								<a href="{[URL::to('custo/'.$e->id)]}">{[$e->$h[0]  ]}</a>
								<ul>
									@foreach($nested as $k=>$v)
									<li>
										<a href="{[URL::to('custo/'.$e->id).'/visible'.$v]}">HTML {[$v]}</a> |
										<a href="{[URL::to('custo/'.$e->id).'/'.$v]}">JSON {[$v]}</a>
									</li>
										
									@endforeach
								</ul>
								@else
								{[$e->$h[0]  ]}
								@endif
								
							</td>
						@endif
					@endforeach
				</tr>
			@endforeach
		</table>
		<br>
		<br>
		<br>
		<h3>Deleted "Custos" (status as 0) </h3>
		<table class='table'>
			<tr>
				<th>resource</th>
			<!-- $h var comes from controller Empresa2, containing
			the header names on table Empresa -->
			@foreach($header as $h)
				@if($h[1]==1)
					<th>
						{[$h[0]  ]}
					</th>
				@endif
			@endforeach
			<th>Action</th>
			</tr>

			@foreach($deleted as $e)
				<tr>
					<td>
						<a href="{[URL::to('showvisiblecusto/'.$e->id)]}">HTML resource {[$e->id]}</a>
						|
						<a href="{[URL::to('custo/'.$e->id)]}">JSON resource {[$e->id]}</a>
					</td>
					@foreach($header as $h)
						@if($h[1]==1)
							<td>
								@if($h[0]=='nome')
								<a href="{[URL::to('custo/'.$e->id)]}">{[$e->$h[0]  ]}</a>
								@else
								{[$e->$h[0]  ]}
								@endif
								
							</td>
						@endif
					@endforeach
					<td>
						{[Form::open(array('url'=>URL::to('showvisiblecusto/'.$e->id)))]}
						<input type="submit" value='reactivate' class='btn btn-link'>
						{[Form::close()]}
					</td>
				</tr>
			@endforeach
		</table>
	</div>
</body>