

@foreach($header as $h)
<div style='width:100px;float:left'>
	{[$h[0] ]}
</div>
<div style='width:300px;float:left'>
	<b>
		{[$limite->$h[0]   ]}
	</b>
</div>
<div style='clear:both'></div>
@endforeach

<br>
<br>
<br>

<a href="{[URL::to('limite/'.$id.'/edit')]} "> ....  Edit .... </a>
<br>
{[ Form::model($limite, array('route' => array('limite.destroy', $limite->IDLimite), 'method' => 'DELETE')) ]}
	<input type="submit" value='DELETE'>
	</form>
	<br>
<a href="{[URL::to('limite')]}">Back to limite</a>