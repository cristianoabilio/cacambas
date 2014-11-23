<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Custo resource number {[$id]}</h1>
		<div class="text-danger">Warning: changes can harm database, be cautious</div>
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
				Custotype (uneditable)
				<br>
				{[$custo ['custogroup'] ]}
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				Category
				<br>
				{[$custo['subclasse_nome'] ]}
				<select name="" id="subclasse_selector" class='form-control hide' >
					<option value=""></option>
					@foreach(Categorycusto::all() as $c)
						<option value="{[$c->id]}" subclasse="{[$c->subclasse_id]}">{[$c->description]}</option>
					@endforeach
				</select>
				<input type="hidden" name='subclasse_id' id='subclasse_id' value="1">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				detalhe
				<br>
				<input type="text" class='form-control' name="detalhe" id="detalhe" value="{[$custo ['detail_detalhe'] ]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				prestadora
				<br>
				<input type="text" class='form-control' name="prestadora" id="prestadora" value="{[$custo ['detail_prestadora'] ]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				descricao
				<br>
				<input type="text" class='form-control' name="descricao" id="descricao" value="{[$custo ['detail_descricao'] ]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				observacao
				<br>
				<input type="text" class='form-control' name="observacao" id="observacao" value="{[$custo ['detail_observacao'] ]}">
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
		<!-- valor_total":23456,"valor_pago -->
		<div class="row">
			<div class="col-sm-2">
				dt_pagamento
				<br>
				<input type="text" class='form-control' name="dt_pagamento" id="dt_pagamento" value="{[$custo ['dt_pagamento'] ]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				valor_total
				<br>
				<input type="text" class='form-control' name="valor_total" id="valor_total" value="{[$custo ['valor_total'] ]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				valor_pago
				<br>
				<input type="text" class='form-control' name="valor_pago" id="valor_pago" value="{[$custo ['valor_pago'] ]}">
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