<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Edit equipamentobasepreco number {[$equipamentobasepreco->id]} for empresa {[$empresa_id]}</h1>
		{[ Form::model($equipamentobasepreco, array('route' => array('empresa.equipamentobasepreco.update', $empresa_id,$equipamentobasepreco->id), 'method' => 'PUT')) ]}
	
 
 
 
 
 
 

		<div class="row">
			<div class="col-sm-3">
				equipamentobase
				<br>
				<select name="equipamentobase_id" id="equipamentobase_id" class="form-control">
					<option value=""></option>
					<?php $sel=''; ?>
					@foreach($equipamentobase as $e)
					<?php if ($e->id==$equipamentobasepreco->equipamentobase_id) { $sel='selected';} ?>
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
				<input type="text" class="form-control" name="preco_base" id="preco_base" value="{[$equipamentobasepreco->preco_base]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-3">
				periodo_minimo
				<br>
				<input type="text" class="form-control" name="periodo_minimo" id="periodo_minimo" value="{[$equipamentobasepreco->periodo_minimo]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-3">
				dia_extra
				<br>
				<input type="text" class="form-control" name="dia_extra" id="dia_extra" value="{[$equipamentobasepreco->dia_extra]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-3">
				preco_extra
				<br>
				<input type="text" class="form-control" name="preco_extra" id="preco_extra" value="{[$equipamentobasepreco->preco_extra]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-3">
				taxa_extra
				<br>
				<input type="text" class="form-control" name="taxa_extra" id="taxa_extra" value="{[$equipamentobasepreco->taxa_extra]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-3">
				multa
				<br>
				<input type="text" class="form-control" name="multa" id="multa" value="{[$equipamentobasepreco->multa]}">
			</div>
		</div>
		<br>
		<br>
		<input type="submit" value='SAVE CHANGES'>
		{[Form::close()]}
		<a href="{[URL::to('empresa/'.$empresa_id.'/visibleequipamentobasepreco')]}">Return to equipamentobasepreco index</a>
		<br>
		<br>
		<br>
	</div>
</body>
