@foreach($header as $h)
<div style='width:100px;float:left'>
	{[$h[0] ]}
</div>
<div style='width:300px;float:left'>
	<b>
		{[$resumoatividade->$h[0]   ]}
	</b>
</div>
<div style='clear:both'></div>
@endforeach
<br>
<br>
<br>


<a href="{[URL::to('resumoatividade/'.$id.'/edit')]} "> ....  Edit .... </a>
<br>


	<br>
<a href="{[URL::to('resumoatividade')]}       ">Back to empresas</a>