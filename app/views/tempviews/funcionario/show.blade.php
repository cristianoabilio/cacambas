@foreach($header as $h)
<div style='width:100px;float:left'>
	{[$h[0] ]}
</div>
<div style='width:300px;float:left'>
	<b>
		{[$funcionario->$h[0]   ]}
	</b>
</div>
<div style='clear:both'></div>
@endforeach
<br>
<br>
<br>


<a href="{[URL::to('funcionario/'.$id.'/edit')]} "> ....  Edit .... </a>
<br>
{[ Form::model($funcionario, array('route' => array('funcionario.destroy', $funcionario->id), 'method' => 'DELETE')) ]}
<input type='submit' value='delete'>
</form>

	<br>
<a href="{[URL::to('funcionario')]}       ">Back to funcionario</a>