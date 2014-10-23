<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>
			Adding a new produtofatura for empresa 
			{[ Empresa::find($empresa_id)->nome ]}
		</h1>
		{[Form::open(array('url'=>URL::to('empresa/'.$empresa_id.'/convenio/'.$convenio_id.'/produtofatura')  ) )]}
			<div class="row">
				<div class="col-sm-2">
					data_compra {[date('Y-m-d')]}
					<br>
					<input type="hidden" class='form-control' name="data_compra" id="data_compra" value="{[date('Y-m-d')]}">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2">
					data_vencimiento
					<br>
					<input type="text" class='form-control' name="data_vencimiento" id="data_vencimiento" >
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2">
					data_pagamento
					<br>
					<input type="text" class='form-control' name="data_pagamento" id="data_pagamento">
				</div>
			</div>
			<hr>
			<h3>Choose produtos to be purchased</h3>
			@foreach(Produto::isproduto()->get() as $p)
				<div class="row">
					<div class="col-sm-2">
						<div class="checkbox">
							<label>
								<input type="checkbox" id='produto{[$p->id]}' class='produto'> {[$p->nome]}
							</label>
						</div>
					</div>
					<div id="produtofields{[$p->id]}" class='produtofields'>
						<div class="col-sm-1">
							Amount
							<br>
							<input type="text" class="form-control">
							
						</div>
						<div class="col-sm-1">
							price
							<br>
							{[$p->valor]}
							<hr>
						</div>
						<div class="col-sm-1">
							custo_extra
							<br>
							{[$p->custo_extra]}
							<hr>
						</div>
						<div class="col-sm-3">
							TOTAL
							<br>
							[pending to add jquery function]
							<hr>
						</div>
					</div>
				</div>
				
			@endforeach
			
			<br>
			<div class="row">
				<div class="col-sm-2">
					valor_subtotal
					<br>
					<input type="text" class='form-control' name="valor_subtotal" id="valor_subtotal">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2">
					valor_ajuste_tipo
					<br>
					<input type="text" class='form-control' name="valor_ajuste_tipo" id="valor_ajuste_tipo">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2">
					valor_ajuste_percentual
					<br>
					<input type="text" class='form-control' name="valor_ajuste_percentual" id="valor_ajuste_percentual">
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
					observacao
					<br>
					<input type="text" class='form-control' name="observacao" id="observacao">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2">
					forma_pagamento
					<br>
					<input type="text" class='form-control' name="forma_pagamento" id="forma_pagamento">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2">
					status_pagamento
					<br>
					<input type="text" class='form-control' name="status_pagamento" id="status_pagamento">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2">
					pagarme
					<br>
					<input type="text" class='form-control' name="pagarme" id="pagarme">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2">
					NSFe
					<br>
					<input type="text" class='form-control' name="NSFe" id="NSFe">
				</div>
			</div>
			<br>
			<input type="submit" value='create'>
			<br>
		{[Form::close()  ]}
		<br>
		<br>
		<a href="{[URL::to('empresa/'.$empresa_id.'/convenio/'.$convenio_id.'/visibleprodutofatura') ]}">Back to convenio index</a>
		<br>
		<br>
		<br>
	</div>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</body>
<script>
	$(function(){
		//Start hiding all produto fields
		$('.produtofields').hide();

		//set each checkbox for toggling produto fields
		$('.produto').each(function(){

			//retrieving produto id
			var id=$(this).attr('id');
			id=id.replace('produto','');

			//setting checkbox behavior
			$('#produto'+id).on('click change',function(){
				if ( $(this).is(':checked') ) {
					$('#produtofields'+id).show('fast');
				} else {
					$('#produtofields'+id).hide('fast');
				}
			});
		});
	});
</script>