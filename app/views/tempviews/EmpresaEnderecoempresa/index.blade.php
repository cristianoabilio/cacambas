<?php  
$fake=new fakeuser;
?>
<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>
			Empresa = {[$empresa->nome]}
		</h1>
		<a href="{[URL::to('empresa/'.$empresa_id.'/enderecoempresa/create')]}">Add new "endereco" to current empresa</a>
		<br>
		<table class='table'>
			<tr>
				<th>Resource id</th>
				@foreach($header as $h)
					@if($h[1]==1)
						<td> enderecoempresa {[$h[0]]} </td>
					@endif
				@endforeach
			</tr>
			@foreach($enderecoempresa as $e)
			<tr>
				<td>
					<a href="{[URL::to('empresa/'.$empresa_id.'/showvisibleenderecoempresa/'.$e->id)]}">HTML resource {[$e->id]}</a>
					|
					<a href="{[URL::to('empresa/'.$empresa_id.'/enderecoempresa/'.$e->id)]}">JSON resource {[$e->id]}</a>
				</td>
				@foreach($header as $h)
					@if($h[1]==1)
						<td>
							{[$e->$h[0] ]}
						</td>
					@endif
				@endforeach
			</tr>
			@endforeach
		</table>
	</div>
</body>
