<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Estado {[ $estado->nome ]}</h1>
		@foreach($header as $h)
		<div style='width:100px;float:left'>
			{[$h[0] ]}
		</div>
		<div style='width:300px;float:left'>
			<b>
				{[$estado->$h[0]   ]}
			</b>
		</div>
		<div style='clear:both'></div>
		@endforeach
		<br>
		<br>
		<br>
		<a href="{[URL::to('estado/'.$id.'/edit')]} "> ....  Edit .... </a>
		<br>
		<br>
		<a href="{[URL::to('visibleestado')]} ">Back to estado index</a>
	</div>
</body>
		
		