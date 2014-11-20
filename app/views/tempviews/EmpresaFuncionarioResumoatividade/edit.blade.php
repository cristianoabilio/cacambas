<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Edit resumoatividade resource number {[$id]}</h1>
		<h2 class="text-danger">Sorry, resource cannot be edited</h2>
		<div class="hide">
			{[Form::model($resumoatividade,array('route'=>array('empresa.funcionario.resumoatividade.update',$empresa_id,$funcionario_id,$id),'method' => 'PUT'))]}
			<div class="row">
				<div class="col-sm-2">
					funcionario_id
					<br>
					<input type="text" class='form-control' name="funcionario_id" id="funcionario_id" value="{[$resumoatividade->funcionario_id]}">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2">
					mes_referencia
					<br>
					<input type="text" class='form-control' name="mes_referencia" id="mes_referencia" value="{[$resumoatividade->mes_referencia]}">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2">
					ano_referencia
					<br>
					<input type="text" class='form-control' name="ano_referencia" id="ano_referencia" value="{[$resumoatividade->ano_referencia]}">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2">
					empresa_id
					<br>
					<input type="text" class='form-control' name="empresa_id" id="empresa_id" value="{[$resumoatividade->empresa_id]}">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2">
					total_os_colocada
					<br>
					<input type="text" class='form-control' name="total_os_colocada" id="total_os_colocada" value="{[$resumoatividade->total_os_colocada]}">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2">
					total_os_troca
					<br>
					<input type="text" class='form-control' name="total_os_troca" id="total_os_troca" value="{[$resumoatividade->total_os_troca]}">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2">
					total_os_retirada
					<br>
					<input type="text" class='form-control' name="total_os_retirada" id="total_os_retirada" value="{[$resumoatividade->total_os_retirada]}">
				</div>
			</div>
			<br>
			<input type="submit" value='save changes'>
			{[Form::close()]}
		</div>
		<a href="{[URL::to('empresa/'.$empresa_id.'/funcionario/'.$funcionario_id.'/visibleresumoatividade')]}">Go back to funcionario index</a>

	</div>
</body>