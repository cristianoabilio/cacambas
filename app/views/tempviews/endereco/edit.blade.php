Edit 
{[$endereco->id]}
<br>
<br>	
<div style='margin-left:200px'>
	
	{[ Form::model($endereco, array('route' => array('endereco.update', $endereco->id), 'method' => 'PUT')) ]}

@foreach($header as $h)


<div style='width:300px;float:left'>
	@if($h[0]=='endereco')
	{[$h[1] ]}
		<input type="text" name="{[$h[1] ]}" id="{[$h[1] ]}" value="{[$endereco->enderecobase->endereco->first()->$h[1]   ]}">	<br>
	@elseif( $h[0]=='enderecobase')
	{[$h[1] ]}
		<input type="text" name="{[$h[1] ]}" id="{[$h[1] ]}" value="{[$endereco->enderecobase->$h[1]   ]}">	<br>
	@elseif( $h[0]=='enderecoempresa' )
	{[$h[1] ]}
		<input type="text" name="{[$h[1] ]}" id="{[$h[1] ]}" value="{[$endereco->$h[1]   ]}">	<br>
	@endif
	<b>
		
	</b>
</div>
<div style='clear:both'></div>
@endforeach

<br>
		<br>
		<input type="submit" value='SAVE CHANGES'>
	</form>

	{[ Form::model($endereco, array('route' => array('endereco.destroy', $endereco->id), 'method' => 'DELETE')) ]}
	<input type="submit" value='DELETE'>
	</form>
</div>