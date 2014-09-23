

@foreach($header as $h)
<div style='width:150px;float:left'>
	{[$h[1] ]}
</div>
<div style='width:300px;float:left'>
	@if($h[0]=='endereco')
		{[$endereco->enderecobase->endereco->first()->$h[1]   ]}
	@elseif( $h[0]=='enderecobase')
		{[$endereco->enderecobase->$h[1]   ]}
	@elseif( $h[0]=='enderecoempresa' )
		{[$endereco->$h[1]   ]}
	@endif
	<b>
		
	</b>
</div>
<div style='clear:both'></div>
@endforeach

<br>
<br>
<br>

<a href="{[URL::to('endereco/'.$id.'/edit')]} "> ....  Edit .... </a>
<br>
{[ Form::model($endereco, array('route' => array('endereco.destroy', $endereco->id), 'method' => 'DELETE')) ]}
	<input type="submit" value='DELETE'>
	</form>
	<br>
<a href="{[URL::to('endereco')]}">Back to endereco</a>