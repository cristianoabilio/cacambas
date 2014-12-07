<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Adding a new anotacoe </h1>
		Data associated to
		<ul>
			<li>Company :{[ Empresa::find($empresa_id)->nome ]}</li>
			<li>User: {[ Cliente::find($cliente_id)->cliente ]}</li>
		</ul>
		{[Form::open(array('url'=>URL::to('empresa/'.$empresa_id.'/cliente/'.$cliente_id.'/anotacoes')  ) )]}
			<div class="row">
				<div class="col-sm-3">
					anotacoe
					<br>
					<input type="text" class="form-control" name="anotacoe" id="anotacoe" placehoder='anotacoe'>
				</div>
			</div>
			<br>
			<br>
			<input type="submit" value='create'>
			<br>
		{[Form::close()  ]}
		<br>
		<br>
		<a href="{[URL::to('empresa/'.$empresa_id.'/cliente/'.$cliente_id.'/visibleanotacoes') ]}">Back to anotacoes index</a>
		<br>
		<br>
		<br>
	</div>
</body>
