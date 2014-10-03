<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>

@foreach($header as $h)
<div style='width:100px;float:left'>
	{[$h[0] ]}
</div>
<div style='width:300px;float:left'>
	<b>
		{[$convenio->$h[0]   ]}
	</b>
</div>
<div style='clear:both'></div>
@endforeach

<br>
<br>
<br>

<a href="{[URL::to('convenio/'.$id.'/edit')]} "> ....  Edit .... </a>
<br>

	<br>
<a href="{[URL::to('convenio')]}">Back to convenio</a>