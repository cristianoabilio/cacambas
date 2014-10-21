<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>resumoatividade specifications</h1>
		@foreach($header as $h)
			<div class="row">
				<div class="col-sm-2">
					{[$h[0] ]}
				</div>
				<div class="col-sm-6 text-info">
					{[$resumoatividade->$h[0]   ]}
				</div>
			</div>
		@endforeach
		<hr>
		<a href="{[URL::to('resumoatividade/'.$id.'/edit')]} "> ....  Edit .... </a><br>
		{[ Form::model($resumoatividade, array('route' => array('empresa.funcionario.resumoatividade.destroy', $empresa_id,$funcionario_id,$id), 'method' => 'DELETE')) ]}
			<input type="submit" value='DELETE'>
		{[Form::close()]}
		<br>
		<a href="{[URL::to('empresa/'.$empresa_id.'/funcionario/'.$funcionario_id.'/visibleresumoatividade')]}">Go back to funcionario index</a>
	</div>
</body>