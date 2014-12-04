<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Anotacoe {[$anotacoe->id]} resource <spam class="text-info">({[ $anotacoe->anotacoe]})</spam>
		</h1>
		<ul>
			<li>Company :{[ Empresa::find($empresa_id)->nome ]}</li>
			<li>User: {[ Login::find($login_id)->login ]}</li>
		</ul>
		@foreach($header as $h)
			<div class="row">
				<div class="col-sm-2">{[$h[0] ]}</div>
				<div class="col-sm-6">{[$anotacoe->$h[0] ]}</div>
			</div>
			
		@endforeach
		<a href="{[URL::to('empresa/'.$empresa_id.'/login/'.$login_id.'/anotacoes/'.$id.'/edit')]} "> ....  Edit .... </a>
		<br><br>
		<a href="{[URL::to('empresa/'.$empresa_id.'/login/'.$login_id.'/visibleanotacoes')]}">Back to anotacoe</a>
		<br>
		<br>
		<br>
	</div>
</body>
