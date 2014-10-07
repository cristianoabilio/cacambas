<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
@foreach($header as $h)
<div style='width:100px;float:left'>
	{[$h[0] ]}
</div>
<div style='width:300px;float:left'>
	<b>
		{[$conta->$h[0]   ]}
	</b>
</div>
<div style='clear:both'></div>
@endforeach
<br>
<br>
<br>

<a href="{[URL::to('contabancaria/'.$id.'/edit')]} "> ....  Edit .... </a>
<br>
{[ Form::model($conta, array('route' => array('contabancaria.destroy', $conta->id), 'method' => 'DELETE')) ]}
	<input type="submit" value='DELETE'>
	</form>
	<br>
<a href="{[URL::to('contabancaria')]}       ">Back to contabancaria</a>