<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div id="base" class="hide">{[URL::to('/')]}</div>
	<div id="empresa" class="hide">{[$empresa_id]}</div>
	<div class="container">
		<h1>Add a new "Custo" to empresa "{[$empresa->nome]}"</h1>
		{[Form::open(array('url'=>URL::to('empresa/'.$empresa_id.'/custo')))]}
		Custo type
		<div class="row">
			<div class="col-sm-2">
				<select id='custotype' name='custotype' class="form-control">
					<option></option>
					<option value="0">general</option>
					<option value="caminhao">caminhao</option>
					<option value="equipamento">equipamento</option>
					<option value="funcionarioLogin">funcionario</option>
				</select>
			</div>
		</div>
		<div id="specific_custo_type" class='hide'>
			select available element
			<div class="row">
				<div class="col-sm-2">
					<select name="custotypeselect" id="custotypeselect" class="form-control">
						<option value=""></option>
					</select>
				</div>
			</div>
		</div>
		<div id="wholecustoform">
			<h4>custodetail fields</h4>
			<div class="row">
				<div class="col-sm-2">
					category
					<br>
					<select name="" id="subclasse_selector" class='form-control' >
						<option value=""></option>
						@foreach(Categorycusto::all() as $c)
							<option value="{[$c->id]}" subclasse="{[$c->subclasse_id]}">{[$c->description]}</option>
						@endforeach
					</select>
				</div>
			</div>
			<input type="hidden" value='' id='subclasse_id' name='subclasse_id'>
			<br>
			<div class="row">
				<div class="col-sm-2">
					detalhe
					<br>
					<input type="text" class='form-control' name="detalhe" id="detalhe">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2">
					prestadora
					<br>
					<input type="text" class='form-control' name="prestadora" id="prestadora">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2">
					descricao
					<br>
					<input type="text" class='form-control' name="descricao" id="descricao">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2">
					observacao
					<br>
					<input type="text" class='form-control' name="observacao" id="observacao">
				</div>
			</div>
			<br>
			<hr>
			<br>
			<div class="row">
				<div class="col-sm-2">
					dt_inicio
					<br>
					<input type="text" class='form-control' name="dt_inicio" id="dt_inicio">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2">
					dt_fim
					<br>
					<input type="text" class='form-control' name="dt_fim" id="dt_fim">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2">
					dt_pagamento
					<br>
					<input type="text" class='form-control' name="dt_pagamento" id="dt_pagamento">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2">
					valor_total
					<br>
					<input type="text" class='form-control' name="valor_total" id="valor_total">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2">
					valor_pago
					<br>
					<input type="text" class='form-control' name="valor_pago" id="valor_pago">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2">
					status_financeiro
					<br>
					<input type="text" class='form-control' name="status_financeiro" id="status_financeiro">
				</div>
			</div>
			<br>
			<br>
			<input type="submit" value='create'>
		</div>
			
		{[Form::close()]}
		<br>
		<a href="{[URL::to('empresa/'.$empresa_id.'/visiblecusto')]}  ">Back to custo</a>
		<br>
		<br>
		<br>
	</div>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</body>
<script type="text/javascript">
	$(function(){
		$('#wholecustoform').hide();

		$('#custotype').change(function(){
			if ($(this).val()=="") {
				$('#wholecustoform').hide('fast');
			} else if ($(this).val()==0) {
				$('#wholecustoform').show('fast');
				$('#specific_custo_type').addClass('hide');
				$('#custotypeselect').html('');
			} else {
				$('#wholecustoform').hide('fast');
				var empresa=$('#empresa').html();
				var element=$('#custotype').val();
				var _token=$('input[name=_token]').val();
				$('#specific_custo_type').removeClass('hide');
				$('#custotypeselect').html('');
				$('#custotypeselect').append('<option></option>');
				var base=$('#base').html();
				$.get(
					base+'/empresa/'+empresa+'/'+element,
					{},
					function(d){
						$.each(d,function(k,v){
							var show=v.id;
							if (v.placa!=null) {
								show=v.placa;
							} else if (v.username!=null) {
								show=v.username+' ('+v.funcao+')';
							} else if (v.classe!=null) {
								show=v.classe+' ('+v.nome+')';
							};
							//
							$('#custotypeselect').append(
								"<option value='"+v.id+"'>"+show+"</option>"
								)
							;
						});
							
				});
			}
		});

		$('#custotypeselect').change(function(e){
			e.preventDefault();
			if ($(this).val()=='') {
				$('#wholecustoform').hide('fast');
			} else {
				$('#wholecustoform').show('fast');
			}
		});

		$('#subclasse_selector').change(function(e){
			//e.preventDefault();
			if ( $(this).val()==''  ) {
				$('#subclasse_id').val('');
			} else {
				var subclasse=$('#subclasse_selector option:selected').attr('subclasse');
				$('#subclasse_id ').val(subclasse);
			}
		});
	});
</script>
