<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Fatura number {[$id]} </h1>
		@foreach($header as $h)
		<div style='width:150px;float:left'>
			{[$h[0] ]}
		</div>
		<div style='width:300px;float:left'>
			<b>
				{[$fatura->$h[0]   ]}
			</b>
		</div>
		<div style='clear:both'></div>
		@endforeach
		<br>

		<a href="{[URL::to('empresa/'.$empresa_id.'/convenio/'.$convenio_id.'/fatura/'.$id.'/edit')]} "> ....  Edit .... </a>
		<br>

			<br>
		<a href="{[URL::to('empresa/'.$empresa_id.'/convenio/'.$convenio_id.'/visiblefatura')]}">Back to fatura</a>
	</div>
</body>
