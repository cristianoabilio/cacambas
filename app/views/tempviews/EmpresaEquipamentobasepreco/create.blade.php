<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>
			Add a new "equipamentobasepreco" for empresa {[Empresa::find($empresa_id)->nome]}
		</h1>
		{[Form::open(array('url'=>URL::to('empresa/'.$empresa_id.'/equipamentobasepreco') ))]}
		<div class="row">
			<div class="col-sm-3">
				equipamentobase
				<br>
				<select name="equipamentobase_id" id="equipamentobase_id" class="form-control">
					<option value=""></option>
					@foreach($equipamentobase as $e)
						<option value="{[$e->id]}">{[$e->nome]} - {[$e->classe]}</option>
					@endforeach
				</select>
			</div>
		</div>
		<br>
		<div id="preco_form" class=''>
			<div class="row">
				<div class="col-sm-3">
					preco_base
					<br>
					<input type="text" class="form-control" name="preco_base" id="preco_base">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-3">
					periodo_minimo
					<br>
					<input type="text" class="form-control" name="periodo_minimo" id="periodo_minimo">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-3">
					dia_extra
					<br>
					<input type="text" class="form-control" name="dia_extra" id="dia_extra">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-3">
					preco_extra
					<br>
					<input type="text" class="form-control" name="preco_extra" id="preco_extra">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-3">
					taxa_extra
					<br>
					<input type="text" class="form-control" name="taxa_extra" id="taxa_extra">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-3">
					multa
					<br>
					<input type="text" class="form-control" name="multa" id="multa">
				</div>
			</div>
			<br>
			<br>
			<input type="submit" value='create'>
		</div>
			

		{[Form::close()]}
		<br>
		<a href="{[URL::to('empresa/'.$empresa_id.'/visibleequipamentobasepreco')]}">Return to equipamentobasepreco index</a>
		<br>
		<br>
		<br>
	</div>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</body>
<script type="text/javascript">
	$(function(){
		$('#preco_form').hide('fast');
		$('#equipamentobase_id').change(function(e){
			e.preventDefault();
			if ($(this).val()=="") {
				$('#preco_form').addClass('').hide('fast');
			} else {
				$('#preco_form').removeClass('').show('fast');
			}
		});
	});
</script>




