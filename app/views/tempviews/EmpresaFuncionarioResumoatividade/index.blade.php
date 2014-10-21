<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Index for "resumoatividade" on funcionario {[Funcionario::find($funcionario_id)->nome]}  </h1>
		<div>
			<a href="{[URL::to('empresa/'.$empresa_id.'/funcionario/'.$funcionario_id.'/resumoatividade/create')]}">
				Add new "resumoatividade" for {[Funcionario::find($funcionario_id)->nome]}
			</a>
		</div>
		<br><br>
		<table class='table'>
			<tr>
				<th>Resource</th>
			@foreach($header as $h)
				@if($h[1]==1)
					<th>
						{[$h[0]  ]}
					</th>
				@endif
			@endforeach
			</tr>
			@foreach($resumoatividade as $e)
				<tr>
					<td>
						<a href="{[URL::to('empresa/'.$empresa_id.'/funcionario/'.$funcionario_id.'/showvisibleresumoatividade/'.$e->id)]}">HTML resource {[$e->id]}</a>
						|
						<a href="{[URL::to('empresa/'.$empresa_id.'/funcionario/'.$funcionario_id.'/resumoatividade/'.$e->id)]}">JSON resource {[$e->id]}</a>
					</td>
					@foreach($header as $h)
					
						@if($h[1]==1)
							<td>
								{[$e->$h[0]  ]}
							</td>
						@endif
					@endforeach
				</tr>
			@endforeach
		</table>
		<hr>
	</div>
</body>
<br>
<br>

		