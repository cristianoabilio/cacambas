@foreach($header as $h)
<div style='width:100px;float:left'>
	{[$h[0] ]}
</div>
<div style='width:300px;float:left'>
	<b>
		{[$empresa->$h[0]   ]}
	</b>
</div>
<div style='clear:both'></div>
@endforeach
<br>
<br>
<br>


<a href="{[URL::to('empresa/'.$id.'/edit')]} "> ....  Edit .... </a>
<br>
{[ Form::model($empresa, array('route' => array('empresa.destroy', $empresa->IDEmpresa), 'method' => 'DELETE')) ]}
	<input type="submit" value='DELETE'>
	</form>
	<br>
<a href="{[URL::to('empresa')]}       ">Back to empresas</a>

