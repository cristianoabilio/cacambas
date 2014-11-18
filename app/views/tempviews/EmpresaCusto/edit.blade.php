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
				empresa_id {[$custo ['empresa_id'] ]} no editable
				<input type="hidden" class='form-control' name="empresa_id" id="empresa_id" value="{[$custo ['empresa_id'] ]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				~
				<br>
				~
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				~
				<br>
				~
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				~
				<br>
				~
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				dt_inicio
				<br>
				<input type="text" class='form-control' name="dt_inicio" id="dt_inicio" value="{[$custo ['dt_inicio'] ]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				dt_fim
				<br>
				<input type="text" class='form-control' name="dt_fim" id="dt_fim" value="{[$custo ['dt_fim'] ]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				valor
				<br>
				~
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				status_financeiro
				<br>
				<input type="text" class='form-control' name="status_financeiro" id="status_financeiro" value="{[$custo ['status_financeiro'] ]}">	
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				~
				<br>
				~
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				~
				<br>
				~
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				~
				<br>
				~
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				~
				<br>
				~
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				~
				<br>
				~
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