<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Equipamento </h1>
		<a href="{[URL::to('equipamentoitem/create')]}"> Add new  </a>
		<br>
		<table class='table'>
			<!-- $h var comes from controller , containing
			the header names on table  -->
			<tr>
				<th> Resource </th>
				@foreach($header as $h)
					@if($h[1]==1)
						<th> {[$h[0]  ]} </th>
					@endif
				@endforeach
			</tr>
			@foreach($equipamentoitem as $e)
				<tr>
					<td>
						<a href="{[URL::to('showvisibleequipamentoitem/'.$e->id)]}">HTML {[$e->nome]}</a>
						|
						<a href="{[URL::to('equipamentoitem/'.$e->id)]}">JSON {[$e->nome]}</a>
					</td>
					@foreach($header as $h)
						@if($h[1]==1)
							<td>{[$e->$h[0]  ]}</td>
						@endif
					@endforeach
				</tr>
			@endforeach
		</table>
	</div>
</body>
		