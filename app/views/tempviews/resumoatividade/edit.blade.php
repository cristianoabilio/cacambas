<?php  
$fake=new fakeuser;
?><head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Funcionario {[$resumoatividade->Funcionario->nome]}</h1>
		<p>
			empresa <b> {[$resumoatividade->Funcionario->Empresa->nome]}</b>
		</p>
		Edit register number
		{[$resumoatividade->id]}
		{[ Form::model($resumoatividade, array('route' => array('funcionario.resumoatividade.update',$resumoatividade->Funcionario->id,$resumoatividade->id), 'method' => 'PUT')) ]}
		<div class="row">
			<div class="col-sm-2">
				mes_referencia
			</div>
			<div class="col-sm-6">
				<input type="text" name="mes_referencia" id="mes_referencia" value="{[$resumoatividade->mes_referencia]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				ano_referencia
			</div>
			<div class="col-sm-6">
				<input type="text" name="ano_referencia" id="ano_referencia" value="{[$resumoatividade->ano_referencia]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				total_os_colocada
			</div>
			<div class="col-sm-6">
				<input type="text" name="total_os_colocada" id="total_os_colocada" value="{[$resumoatividade->total_os_colocada]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				total_os_troca
			</div>
			<div class="col-sm-6">
				<input type="text" name="total_os_troca" id="total_os_troca" value="{[$resumoatividade->total_os_troca]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				total_os_retirada
			</div>
			<div class="col-sm-6">
				<input type="text" name="total_os_retirada" id="total_os_retirada" value="{[$resumoatividade->total_os_retirada]}">
			</div>
		</div>
		<br>
		<input type="submit" value='SAVE CHANGES'>
		{[Form::close()]}
		
	</div>
</body>
