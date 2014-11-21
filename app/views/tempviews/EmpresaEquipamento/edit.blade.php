<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Edit equipamento number {[$equipamentodetail->id]} for empresa {[$empresa_id]}</h1>
		{[ Form::model($equipamentodetail, array('route' => array('empresa.equipamento.update', $empresa_id,$id), 'method' => 'PUT')) ]}
	
		<div class="row">
			<div class="col-sm-3">
				equipamento 
				<br>
				<select name="equipamento_id" id="equipamento_id" class="form-control">
					<option value=""></option>
					@foreach($equipamento as $e)
					<?php $sel=''; if ($e->id==$choosen) { $sel='selected';} ?>
						<option value="{[$e->id]}" {[$sel]}>{[$e->nome]} - {[$e->classe]}</option>
					@endforeach
				</select>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-3">
				preco_base
				<br>
				<input type="text" class="form-control" name="preco_base" id="preco_base" value="{[$equipamentodetail->preco_base]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-3">
				periodo_minimo
				<br>
				<input type="text" class="form-control" name="periodo_minimo" id="periodo_minimo" value="{[$equipamentodetail->periodo_minimo]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-3">
				dia_extra
				<br>
				<input type="text" class="form-control" name="dia_extra" id="dia_extra" value="{[$equipamentodetail->dia_extra]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-3">
				preco_extra
				<br>
				<input type="text" class="form-control" name="preco_extra" id="preco_extra" value="{[$equipamentodetail->preco_extra]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-3">
				taxa_extra
				<br>
				<input type="text" class="form-control" name="taxa_extra" id="taxa_extra" value="{[$equipamentodetail->taxa_extra]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-3">
				valor_multa
				<br>
				<input type="text" class="form-control" name="valor_multa" id="valor_multa" value="{[$equipamentodetail->valor_multa]}">
			</div>
		</div>
		<br>
		<br>
		<input type="submit" value='SAVE CHANGES'>
		{[Form::close()]}
		<a href="{[URL::to('empresa/'.$empresa_id.'/visibleequipamento')]}">Return to equipamento index</a>
		<br>
		<br>
		<br>
	</div>
</body>
