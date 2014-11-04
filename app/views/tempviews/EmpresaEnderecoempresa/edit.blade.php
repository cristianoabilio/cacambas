<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Edit endereco record number {[$enderecoempresa->id]}</h1>
		<div id="current_data">
			<div id="estado_id">{[$enderecoempresa->endereco->enderecobase->bairro->cidade->estado->id]}</div>
			<div id="cidade_id">{[$enderecoempresa->endereco->enderecobase->bairro->cidade->id]}</div>
			<div id="bairro_id">{[$enderecoempresa->endereco->enderecobase->bairro->id]}</div>
			<!-- Before edit / update values on endereco table-->
			<div id="def_enderecobase_id">{[$enderecoempresa->endereco->enderecobase->id]}</div>
			<div id="def_numero">{[$enderecoempresa->endereco->numero]}</div>
			<div id="def_cep">{[$enderecoempresa->endereco->cep]}</div>
			<div id="def_latitude">{[$enderecoempresa->endereco->latitude]}</div>
			<div id="def_longitude">{[$enderecoempresa->endereco->longitude]}</div>
			<div id="def_restricao_hr_inicio">{[$enderecoempresa->endereco->restricao_hr_inicio]}</div>
			<div id="def_restricao_hr_fim">{[$enderecoempresa->endereco->restricao_hr_fim]}</div>
			<!-- Before edit / update values on enderecoempresa table-->
			<div id="def_endereco_id">{[$enderecoempresa->endereco_id]}</div>
			<div id="def_tipo">{[$enderecoempresa->tipo]}</div>
			<div id="def_complemento">{[$enderecoempresa->complemento]}</div>
			<div id="def_observacao">{[$enderecoempresa->observacao]}</div>
			<div id="def_status">{[$enderecoempresa->status]}</div>
		</div>
		Enderecoempresa for
		estado {[$enderecoempresa->endereco->enderecobase->bairro->cidade->estado->nome]}
		<a href="" id="change_estado">change</a>
		{[ Form::model($enderecoempresa, array('route' => array('empresa.enderecoempresa.update', $empresa_id,$id), 'method' => 'PUT')) ]}
		<h4>Endereco</h4>
		<div class="row">
			<div class="col-sm-2">
				enderecobase_id (hidden and automaticly asigned)
				<br>
				<input type="text" class='form-control' name="enderecobase_id" id="enderecobase_id" value="{[$enderecoempresa->endereco->enderecobase_id]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				numero
				<br>
				<input type="text" class='form-control' name="numero" id="numero" value="{[$enderecoempresa->endereco->numero]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				cep
				<br>
				<input type="text" class='form-control' name="cep" id="cep" value="{[$enderecoempresa->endereco->cep]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				latitude
				<br>
				<input type="text" class='form-control' name="latitude" id="latitude" value="{[$enderecoempresa->endereco->latitude]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				longitude
				<br>
				<input type="text" class='form-control' name="longitude" id="longitude" value="{[$enderecoempresa->endereco->longitude]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				restricao_hr_inicio
				<br>
				<input type="text" class='form-control' name="restricao_hr_inicio" id="restricao_hr_inicio" value="{[$enderecoempresa->endereco->restricao_hr_inicio]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				restricao_hr_fim
				<br>
				<input type="text" class='form-control' name="restricao_hr_fim" id="restricao_hr_fim" value="{[$enderecoempresa->endereco->restricao_hr_fim]}">
			</div>
		</div>
		<br>

		<h4>Enderecoempresa</h4>
		<div class="row">
			<div class="col-sm-2">
				endereco_id (hidden and automaticly changed if endereco changes)
				<br>
				<input type="text" class='form-control' name="endereco_id" id="endereco_id" value="{[$enderecoempresa->endereco_id]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				tipo
				<br>
				<input type="text" class='form-control' name="tipo" id="tipo" value="{[$enderecoempresa->tipo]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				complemento
				<br>
				<input type="text" class='form-control' name="complemento" id="complemento" value="{[$enderecoempresa->complemento]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				observacao
				<br>
				<input type="text" class='form-control' name="observacao" id="observacao" value="{[$enderecoempresa->observacao]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				status
				<br>
				<input type="text" class='form-control' name="status" id="status" value="{[$enderecoempresa->status]}">
			</div>
		</div>
		<br>
		<input type="submit" value='SAVE CHANGES'>
		<br>
		{[Form::close()]}
		<br>
		{[ Form::model($enderecoempresa, array('route' => array('empresa.enderecoempresa.destroy', $empresa_id,$id), 'method' => 'DELETE')) ]}
			<input type="submit" value='DELETE'>
		{[Form::close()]}
		<br>
		<a href="{[URL::to('empresa/'.$empresa_id.'/visibleenderecoempresa') ]}">Back to enderecoempresa index</a>
		<br>
		<br>
	</div>
</body>	