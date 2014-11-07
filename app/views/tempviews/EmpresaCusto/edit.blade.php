<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Custo resource number {[$id]}</h1>
		<div class="text-danger">Warning: changes can harm database, be cautios</div>
		{[ Form::model($custo, array('route' => array('empresa.custo.update', $empresa_id,$id), 'method' => 'PUT')) ]}
		<div class="row">
			<div class="col-sm-2">
				empresa_id {[$custo->empresa_id]} no editable
				<input type="hidden" class='form-control' name="empresa_id" id="empresa_id" value="{[$custo->empresa_id]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				equipamento_id
				<br>
				<input type="text" class='form-control' name="equipamento_id" id="equipamento_id" value="{[$custo->equipamento_id]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				caminhao_id
				<br>
				<input type="text" class='form-control' name="caminhao_id" id="caminhao_id" value="{[$custo->caminhao_id]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				funcionario_id
				<br>
				<input type="text" class='form-control' name="funcionario_id" id="funcionario_id" value="{[$custo->funcionario_id]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				dt_inicio
				<br>
				<input type="text" class='form-control' name="dt_inicio" id="dt_inicio" value="{[$custo->dt_inicio]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				dt_fim
				<br>
				<input type="text" class='form-control' name="dt_fim" id="dt_fim" value="{[$custo->dt_fim]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				valor
				<br>
				<input type="text" class='form-control' name="valor" id="valor" value="{[$custo->valor]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				status_financeiro
				<br>
				<input type="text" class='form-control' name="status_financeiro" id="status_financeiro" value="{[$custo->status_financeiro]}">	
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				prestadora
				<br>
				<input type="text" class='form-control' name="prestadora" id="prestadora" value="{[$custo->prestadora]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				detalhe
				<br>
				<input type="text" class='form-control' name="detalhe" id="detalhe" value="{[$custo->detalhe]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				classe_id
				<br>
				<input type="text" class='form-control' name="classe_id" id="classe_id" value="{[$custo->classe_id]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				subclasse_id
				<br>
				<input type="text" class='form-control' name="subclasse_id" id="subclasse_id" value="{[$custo->subclasse_id]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				dthr_cadastro
				<br>
				<input type="text" class='form-control' name="dthr_cadastro" id="dthr_cadastro" value="{[$custo->dthr_cadastro]}">
			</div>
		</div>
		<br>
		<input type="submit" value='save changes' class='btn btn-default'>
		{[Form::close()]}

		
		<hr>
		<br>
		<br>
		<a href="{[URL::to('empresa/'.$empresa_id.'/visiblecusto')]}  ">Back to custo</a>
		{[ Form::model($custo, array('route' => array('empresa.custo.destroy', $empresa_id,$id), 'method' => 'DELETE')) ]}
		<input type="submit" value='DELETE' class='btn btn-link'>
		{[Form::close()]}
	</div>
</body>