

@foreach($header as $h)
<div style='width:100px;float:left'>
	{[$h[0] ]}
</div>
<div style='width:300px;float:left'>
	<b>
		{[$endereco->$h[0]   ]}
	</b>
</div>
<div style='clear:both'></div>
@endforeach

<br>
<br>
<br>

<a href="{[URL::to('endereco/'.$id.'/edit')]} "> ....  Edit .... </a>
<br>
{[ Form::model($endereco, array('route' => array('endereco.destroy', $endereco->IDEndereco), 'method' => 'DELETE')) ]}
	<input type="submit" value='DELETE'>
	</form>
	<br>
<a href="{[URL::to('endereco')]}">Back to empresas</a>