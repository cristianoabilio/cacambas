<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div id='base' class="hide">{[URL::to('/')]}</div>
	<div class="container">
		@include('tempviews.loginfaker')
		 <h1>Caminhao </h1>
		 <a href="{[URL::to('empresa/'.$empresa_id.'/caminhao/create')]}">
			Add new "caminhao"
		</a>
		<br>
		<h3>Active (status as 1) caminhaos</h3>
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
			@foreach($caminhao as $e)
				<tr>
					<td>
						<a href="{[URL::to('empresa/'.$empresa_id.'/showvisiblecaminhao/'.$e->id)]}">HTML resource {[$e->id]}</a>
						|
						<a href="{[URL::to('empresa/'.$empresa_id.'/caminhao/'.$e->id)]}">JSON resource {[$e->id]}</a>
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
		<h3>Inactive (status as 0) caminhaos</h3>
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
			@foreach($caminhao_0 as $e)
				<tr>
					<td>
						<a href="{[URL::to('empresa/'.$empresa_id.'/showvisiblecaminhao/'.$e->id)]}">HTML resource {[$e->id]}</a>
						|
						<a href="{[URL::to('empresa/'.$empresa_id.'/caminhao/'.$e->id)]}">JSON resource {[$e->id]}</a>
					</td>
					@foreach($header as $h)
						@if($h[1]==1)
							<td>{[$e->$h[0]  ]}</td>
						@endif
					@endforeach
					<td>
						{[Form::open(array('url'=>URL::to('empresa/'.$empresa_id.'/showvisiblecaminhao/'.$e->id)))]}
						<input type="submit" value='reactivate' class='btn btn-link'>
						{[Form::close()]}
					</td>
				</tr>
			@endforeach
		</table>
	</div>
</body>
		