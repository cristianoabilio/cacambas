<?php  
$fake=new fakeuser;
?>
<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>
			Endereco for {[ Empresa::find($fake->empresa() )->nome]}
		</h1>
		<a href="{[URL::to('endereco/create')]}">Add new "endereco"</a>
		<br>
		<table class='table'>
			<tr>
			@foreach($header as $h)
				@if($h[2]==1)
					@if($h[0]=='endereco')
						<td>endereco {[$h[1]]} </td>
					@elseif($h[0]=='enderecobase')
						<td> enderecobase {[$h[1]]} </td>
					@elseif($h[0]=='enderecoempresa')
						<td> enderecoempresa {[$h[1]]} </td>
					@endif
				@endif
			@endforeach
			</tr>
			@foreach($enderecoempresa as $e)
			<tr>
				@foreach($header as $h)
					@if($h[2]==1)
						@if($h[0]=='endereco')
						<td> 
							@if($h[1]=='numero')
								<a href="{[URL::to('endereco/'.$e->id)]}">{[$e->enderecobase->endereco->first()->$h[1] ]} </a>
							@else
								{[$e->enderecobase->endereco->first()->$h[1] ]} 
							@endif
						</td>
						@elseif($h[0]=='enderecobase')
						<td> {[$e->enderecobase->$h[1]]} </td>
						@elseif($h[0]=='enderecoempresa')
						<td> {[$e->$h[1]]} </td>
						@endif
					@endif
				@endforeach
			</tr>	
			@endforeach
		</table>
	</div>
</body>
