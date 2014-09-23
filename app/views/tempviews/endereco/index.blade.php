<?php  
$fake=new fakeuser;
?>



Endereco for {[ Empresa::find($fake->empresa() )->nome]}
<br>
<br>
<a href="{[URL::to('endereco/create')]}">Add new "endereco"</a>
<br>
<table>
	<tr>
	@foreach($header as $h)
	
		@if($h[0]=='endereco')
		<td>endereco {[$h[1]]} </td>
		@elseif($h[0]=='enderecobase')
		<td> enderecobase{[$h[1]]} </td>
		@elseif($h[0]=='enderecoempresa')
		<td> enderecoempresa{[$h[1]]} </td>
		@endif
		
	@endforeach
	</tr>
	@foreach($enderecoempresa as $e)
	<tr>
		@foreach($header as $h)
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
		@endforeach
	</tr>	
	@endforeach
</table>
 
<br>
<br>

