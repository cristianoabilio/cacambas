<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		 <h1>Classe </h1>
		 <a href="{[URL::to('classe/create')]}">
			Add new "classe"
		</a>
		<br>
		<h3>Active (status as 1) classes</h3>
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
			@foreach($classe as $e)
				<tr>
					<td>
						<a href="{[URL::to('showvisibleclasse/'.$e->id)]}">HTML resource {[$e->id]}</a>
						|
						<a href="{[URL::to('classe/'.$e->id)]}">JSON resource {[$e->id]}</a>
						<ul>
							<li>
								<a href="{[URL::to('classe/'.$e->id).'/visiblesubclasse']}">subclasse HTML resource {[$e->id]}</a>
								|
								<a href="{[URL::to('classe/'.$e->id).'/subclasse']}">subclasse JSON resource {[$e->id]}</a>
							</li>
						</ul>
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
		<h3>Inactive (status as 0) classes</h3>
		<table class='table text-muted'>
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
			<th>Action</th>
			</tr>
			@foreach($classe_0 as $e)
				<tr>
					<td>
						<a href="{[URL::to('showvisibleclasse/'.$e->id)]}">HTML resource {[$e->id]}</a>
						|
						<a href="{[URL::to('classe/'.$e->id)]}">JSON resource {[$e->id]}</a>
						<ul>
							<li>
								<a href="{[URL::to('classe/'.$e->id).'/visiblesubclasse']}">subclasse HTML resource {[$e->id]}</a>
								|
								<a href="{[URL::to('classe/'.$e->id).'/subclasse']}">subclasse JSON resource {[$e->id]}</a>
							</li>
						</ul>
					</td>
					@foreach($header as $h)
						@if($h[1]==1)
							<td>{[$e->$h[0]  ]}</td>
						@endif
					@endforeach
					<td>
						{[Form::open(array('url'=>URL::to('showvisibleclasse/'.$e->id)))]}
						<input type="submit" value='reactivate' class='btn btn-link'>
						{[Form::close()]}
					</td>
				</tr>
			@endforeach
		</table>
	</div>
</body>
		