<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>
		Edit fatura resource number {[$id]} for empresa {[Empresa::find($empresa_id)->nome]}
		</h1>
		{[Form::model($fatura,array('route'=>array('empresa.convenio.fatura.update',$empresa_id,$convenio_id,$id),'method' => 'PUT'))]}
		In progress
		{[Form::close()]}
	</div>
</body>