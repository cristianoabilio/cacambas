

@foreach($header as $h)
<div style='width:100px;float:left'>
	{[$h[0] ]}
</div>
<div style='width:300px;float:left'>
	<b>
		{[$plano->$h[0]   ]}
	</b>
</div>
<div style='clear:both'></div>
@endforeach

<br>
<br>
<br>

<a href="{[URL::to('plano/'.$id.'/edit')]} "> ....  Edit .... </a>
<br>
{[ Form::model($plano, array('route' => array('plano.destroy', $plano->IDPlano), 'method' => 'DELETE')) ]}
	<input type="submit" value='DELETE'>
	</form>
	<br>
<a href="{[URL::to('limite')]}">Back to plano</a>