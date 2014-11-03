<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>
			Add a new enderecoempresa
		</h1>
		<div class="text-warning">
			Notes on this view:
			<ul>
				<li>This view sends data to the @store action on controller</li>
				<li>The empresa_id is a must on the store action</li>
				<li>This view will not be used in the definitive project</li>
				<li>
					empresa_id has been set as a select list, nonetheless it will be 
					allowed in two ways: a) if user profile is "normal", empresa_id
					will be automaticly added according to user empresa. b) superuser
					will be asked to choose empresa
				</li>
			</ul>
		</div>
		data related to 
		<ul>
			<li>Endereco: {[$endereco->cep]}</li>
			<li>
				Enderecobase: {[$endereco->enderecobase->cep_base]}
			</li>
			<li>
				Bairro: {[$endereco->enderecobase->bairro->nome]}
			</li>
			<li>
				Cidade: {[$endereco->enderecobase->bairro->cidade->nome]}
			</li>
			<li>
				Estado: {[$endereco->enderecobase->bairro->cidade->estado->nome]}
			</li>
		</ul>
		{[Form::open(array('url'=>URL::to('estado/'.$estado_id.'/cidade/'.$cidade_id.'/bairro/'.$bairro_id.'/enderecobase/'.$enderecobase_id.'/endereco/'.$endereco_id.'/enderecoempresa')  )  )]}
		<div class="row">
			<div class="col-sm-2">
				empresa
				<br>
				<select name="empresa_id" id="empresa_id" class='form-control'>
					<option value=""></option>
					@foreach(Empresa::all() as $e)
						<option value="{[$e->id]}">{[$e->nome]}</option>
					@endforeach
				</select>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				tipo
				<br>
				<input type="text" name="tipo" id="tipo" class='form-control'>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				complemento
				<br>
				<input type="text" name="complemento" id="complemento" class='form-control'>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				observacao
				<br>
				<input type="text" name="observacao" id="observacao" class='form-control'>
			</div>
		</div>
		<br>
		<input type="submit" value='create'>
		{[Form::close()]}
		<br>
		<a href="{[URL::to('estado/'.$estado_id.'/cidade/'.$cidade_id.'/bairro/'.$bairro_id.'/enderecobase/'.$enderecobase_id.'/endereco/'.$endereco_id.'/visibleenderecoempresa') ]}">Back to enderecoempresa index</a>
		<br>
		<br>
		<br>
	</div>
</body>