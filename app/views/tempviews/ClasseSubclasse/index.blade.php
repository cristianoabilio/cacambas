<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		 <h1>Subclasse </h1>
		 <a href="{[URL::to('classe/'.$id.'/subclasse/create')]}">
			Add new "classe"
		</a>
		<br>
		<table class='table'>
			<!-- $h var comes from controller , containing
			the header names on table  -->
			<tr>
				<th>
					Resource
				</th>
			@foreach($header as $h)
				@if($h[1]==1)
					<th>
						{[$h[0]  ]}
					</th>
				@endif
			@endforeach
			</tr>
			@foreach($subclasse as $e)
				<tr>
					<td>
						<a href="{[URL::to('classe/'.$id.'/showvisiblesubclasse/'.$e->id)]}">HTML resource {[$e->id]}</a>
						|
						<a href="{[URL::to('classe/'.$id.'/subclasse/'.$e->id)]}">JSON resource {[$e->id]}</a>
						
					</td>
					@foreach($header as $h)
						@if($h[1]==1)
							<td>{[$e->$h[0]  ]}</td>
						@endif
					@endforeach
				</tr>
			@endforeach
		</table>
		<hr>
		<h3>inactive subclasses</h3>
		<table class='table'>
			<!-- $h var comes from controller , containing
			the header names on table  -->
			<tr>
				<th>
					Resource
				</th>
			@foreach($header as $h)
				@if($h[1]==1)
					<th>
						{[$h[0]  ]}
					</th>
				@endif
			@endforeach
			<th>action</th>
			</tr>
			@foreach($subclasse_inactive as $e)
				<tr>
					<td>
						<a href="{[URL::to('classe/'.$id.'/showvisiblesubclasse/'.$e->id)]}">HTML resource {[$e->id]}</a>
						|
						<a href="{[URL::to('classe/'.$id.'/subclasse/'.$e->id)]}">JSON resource {[$e->id]}</a>
						
					</td>
					@foreach($header as $h)
						@if($h[1]==1)
							<td>{[$e->$h[0]  ]}</td>
						@endif
					@endforeach
					<td>
						{[ Form::open( array('url'=>URL::to('classe/'.$id.'/showvisiblesubclasse/'.$e->id)  ) ) ]}
						<input type='submit' value='reactivate' class='btn btn-link'>
						{[Form::close()]}
					</td>
				</tr>
			@endforeach
		</table>
	</div>
</body>
		