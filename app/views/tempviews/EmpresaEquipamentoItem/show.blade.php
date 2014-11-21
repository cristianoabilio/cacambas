<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Equipamento item number {[$id]} for empresa {[$empresa_id]}</h1>
		Data is related to next resources
		<ul>
			<li>Empresa: {[$empresa->nome]}</li>
			<li>Equipamento: {[$equipamento->classe]} ({[$equipamento->nome]})</li>
		</ul>
		@foreach($header as $h)
		<div class="row">
			<div class="col-sm-2">{[$h[0] ]}</div>
			<div class="col-sm-6">{[$equipamentoitem->$h[0]   ]}</div>
		</div>
		@endforeach
		<a href="{[URL::to('empresa/'.$empresa_id.'/equipamento/'.$equipamentodetail_id.'/items/'.$id.'/edit')]} "> ....  Edit .... </a>
		<br>
		<br>
		<a href="{[URL::to('empresa/'.$empresa_id.'/equipamento/'.$equipamentodetail_id.'/visibleitems/')]}">Back to equipamento</a>
	</div>
</body>