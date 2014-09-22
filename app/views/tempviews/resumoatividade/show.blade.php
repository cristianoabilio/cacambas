<h1>Funcionario {[$resumoatividade->Funcionario->nome]}</h1>
<p>
	empresa <b> {[$resumoatividade->Funcionario->Empresa->nome]}</b>
</p>


@foreach($header as $h)
<div style='width:200px;float:left'>
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


<a href="{[URL::to('funcionario/'.$funcionario->id.'/resumoatividade/'.$id.'/edit')]} "> ....  Edit .... </a>
<br>


	<br>
<a href="{[URL::to('funcionario/'.$funcionario->id.'/resumoatividade')]}       ">Back to resumoatividade</a>