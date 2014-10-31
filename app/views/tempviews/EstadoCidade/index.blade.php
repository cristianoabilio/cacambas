<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		 <h1>Cidade for {[Estado::find($estado_id)->nome]}</h1>
		 <a href="{[URL::to('estado/'.$estado_id.'/cidade/create')]}">
			Add new "cidade" to {[Estado::find($estado_id)->nome]}
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
			@foreach($cidade as $e)
				<tr>
					<td>
						<a href="{[URL::to('estado/'.$estado_id.'/showvisiblecidade/'.$e->id)]}">HTML resource {[$e->nome]}</a>
						|
						<a href="{[URL::to('estado/'.$estado_id.'/cidade/'.$e->id)]}">JSON resource {[$e->nome]}</a>
						<ul>
							<li>
								<a href="{[URL::to('estado/'.$estado_id.'/cidade/'.$e->id.'/visiblebairro')]}">HTLM bairro resources for cidade {[$e->nome]}</a>
								|
								<a href="{[URL::to('estado/'.$estado_id.'/cidade/'.$e->id.'/bairro')]}">JSON barrio resources for cidade {[$e->nome]}</a>
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
	</div>
</body>
		