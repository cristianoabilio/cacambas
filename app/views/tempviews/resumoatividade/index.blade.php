<?php 
$fake=new fakeuser;
?>
<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1> {[$funcionario->nome ]} </h1>
		<small>{[$funcionario->Empresa->nome ]} </small>
		<br>
		<hr>
		<a href="{[URL::to('funcionario/'.$funcionario->id.'/resumoatividade/create')]}">
			Add new "resumoatividade"
			for <b>{[$funcionario->nome ]}</b>
		</a>
		<br>
		<table class='table'>
			<!-- $h var comes from controller Empresa2, containing
			the header names on table Empresa -->
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
			@foreach($resumoatividade as $e)
				<tr>
					<td>
						<a href="{[URL::to('funcionario/'.$funcionario->id.'/resumoatividade/'.$e->id)]}">Number {[$e->id]}</a>
						
					</td>
					@foreach($header as $h)
						@if($h[1]==1)
							<td>
								@if($h[0]=='empresa_id')
								<a href="{[URL::to('funcionario/'.$funcionario->id.'resumoatividade/'.$e->id)]}">{[ $e->$h[0]  ]}</a>
								@elseif($h[0]=='funcionario_id')
								{[Funcionario::find($e->$h[0] )->nome ]}
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
  - 

		
		

		