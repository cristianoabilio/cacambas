@foreach($header as $h)
<div style='width:100px;float:left'>
	{[$h[0] ]}
</div>
<div style='width:300px;float:left'>
	<b>
		{[$compras->$h[0]   ]}
	</b>
</div>
<div style='clear:both'></div>
@endforeach
<br>
<br>
<br>


<a href="{[URL::to('compras/'.$id.'/edit')]} "> ....  Edit .... </a>
<br>
{[ Form::model($compras, 
	array(
	'route' => array('compras.destroy', 
	$compras->id
	)
	, 'method' => 'DELETE')) ]}
	<input type="submit" value='DELETE'>
	</form>
	<br>
<a href="{[URL::to('compras')]}       ">Back to empresas</a>