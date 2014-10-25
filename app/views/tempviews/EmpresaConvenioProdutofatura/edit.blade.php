<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Edit produtofatura resource number {[$id]}</h1>
		{[Form::model($produtofatura,array('route'=>array('empresa.convenio.produtofatura.update',$empresa_id,$convenio_id,$id),'method' => 'PUT'))]}
		<div class="row">
			<div class="col-sm-2 text-right">
				data_compra 
			</div>
			<div class="col-sm-2">
				<input type="text" class='form-control' name="data_compra" id="data_compra" value="{[$produtofatura->data_compra]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2 text-right">
				data_vencimiento
			</div>
			<div class="col-sm-2">
				<input type="text" class='form-control' name="data_vencimiento" id="data_vencimiento" value="{[$produtofatura->data_vencimiento]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2 text-right">
				data_pagamento
			</div>
			<div class="col-sm-2">
				<input type="text" class='form-control' name="data_pagamento" id="data_pagamento" value="{[$produtofatura->data_pagamento]}">
			</div>
		</div>
		<hr>
		<h3>Purchased produtos</h3>
		<?php
		$pairedproductamount='';
		$comma='';
		?>
		@foreach(Produto::isproduto()->get() as $p)
			<?php  
			//retrieving produtocompra item for current
			//invoice and iterated product
			//$pcompra contains unparsed query
			$pcompra=Produtocompra::onfatura($id,$p->id);

			//Empty variables.
			$checked='';
			$quantidade=0;
			$classpurchased='text-muted';
			

			//Filling variables if condition is true
			if ( $pcompra->count()>0 ) {
				$p_c=$pcompra->first();
				$checked='checked';
				$quantidade=$p_c->quantidade;
				$classpurchased='';
				//$pairedproductamount=$pairedproductamount+.','.+
				//$pairedproductamount=$pairedproductamount.$comma.strval($p_c->id).':'.strval($amount);
				$pairedproductamount=$pairedproductamount.$comma.$p_c->produto_id.':'.$quantidade;
				$comma=',';
			}
			?>
			<div class="row">
				<div class="col-sm-2">
					<div class="checkbox">
						<label>
							<input type="checkbox" id='produto{[$p->id]}' class='produto' {[$checked]}>
							<spam class="{[$classpurchased]}">{[$p->nome]}</spam>
						</label>
					</div>
				</div>
				<div id="produtofields{[$p->id]}" class='produtofields'>
					<div class="col-sm-1">
						Amount
						<br>
						<input type="text" id='amount{[$p->id]}' class="form-control" value='{[$quantidade]}'>
					</div>
					<div class="col-sm-1">
						price
						<br>
						<spam id="price{[$p->id]}">{[$p->valor]}</spam>
						<hr>
					</div>
					<div class="col-sm-1">
						custo_extra
						<br>
						<spam id="extra{[$p->id]}">{[$p->custo_extra]}</spam>
						<hr>
					</div>
					<div class="col-sm-3">
						TOTAL
						<br>
						<spam id="total{[$p->id]}">{[($p->valor+$p->custo_extra)*$quantidade]}</spam>
						<hr>
					</div>
				</div>
			</div>
		@endforeach
		<input type="hidden" id="products" name='products' value='{[$pairedproductamount]}'>
		<br>
		<div class="row">
			<div class="col-sm-2 text-right">
				valor_subtotal
			</div>
			<div class="col-sm-2">
				<input type="text" class='form-control' name="valor_subtotal" id="valor_subtotal" value="{[$produtofatura->valor_subtotal]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2 text-right">
				valor_ajuste_tipo
			</div>
			<div class="col-sm-2">
				<input type="text" class='form-control' name="valor_ajuste_tipo" id="valor_ajuste_tipo" value="{[$produtofatura->valor_ajuste_tipo]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2 text-right">
				valor_ajuste_percentual
			</div>
			<div class="col-sm-2">
				<input type="text" class='form-control' name="valor_ajuste_percentual" id="valor_ajuste_percentual" value="{[$produtofatura->valor_ajuste_percentual]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2 text-right">
				valor_total
			</div>
			<div class="col-sm-2">
				<input type="text" class='form-control' name="valor_total" id="valor_total" value="{[$produtofatura->valor_total]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2 text-right">
				observacao
			</div>
			<div class="col-sm-2">
				<input type="text" class='form-control' name="observacao" id="observacao" value="{[$produtofatura->observacao]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2 text-right">
				forma_pagamento
			</div>
			<div class="col-sm-2">
				<input type="text" class='form-control' name="forma_pagamento" id="forma_pagamento" value="{[$produtofatura->forma_pagamento]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2 text-right">
				status_pagamento
			</div>
			<div class="col-sm-2">
				<input type="text" class='form-control' name="status_pagamento" id="status_pagamento" value="{[$produtofatura->status_pagamento]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2 text-right">
				pagarme
			</div>
			<div class="col-sm-2">
				<input type="text" class='form-control' name="pagarme" id="pagarme" value="{[$produtofatura->pagarme]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2 text-right">
				NSFe
			</div>
			<div class="col-sm-2">
				<input type="text" class='form-control' name="NSFe" id="NSFe" value="{[$produtofatura->NSFe]}">
			</div>
		</div>
		<br>
		
		<input type="submit" value='save changes'>
		{[Form::close()]}
		<a href="{[URL::to('empresa/'.$empresa_id.'/convenio/'.$convenio_id.'/visibleprodutofatura') ]}">Back to produtofatura index</a>
		<br>
		<br>
		<br>
		<br>
	</div>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</body>
<script>
$(function(){
	$('.produto').each(function(){

		//retrieving produto id
		var id=$(this).attr('id');
		id=id.replace('produto','');

		//Hiding unchecked produto input tags
		if (!$(this).is(':checked')) {
			$('#produtofields'+id).hide();
		} 
		
		//setting checkbox behavior
		$('#produto'+id).on('click change',function(){
			if ( $(this).is(':checked') ) {
				$('#produtofields'+id).show('fast');
			} else {
				$('#produtofields'+id).hide('fast');
				$('#amount'+id).val('0');
				$('#total'+id).html('0');
				sumsubtotal();
			}
			addcheckedprodutoid();
		});

		//item final price calculation
		$('#amount'+id).on('keyup',function(){
			var amount=parseInt($(this).val(),10);
			var price=parseInt($('#price'+id).html(),10);
			var extra=parseInt($('#extra'+id).html(),10);
			var total=(price+extra)*amount;
			$('#total'+id).html(total);

			sumsubtotal();

			addcheckedprodutoid();
		});
	});

	function sumsubtotal(){
		var subtotal=0;
		$('.produto').each(function(){
			//
			var id=$(this).attr('id');
			id=id.replace('produto','');
			subtotal=subtotal+parseInt($('#total'+id).html(),10);
			$('#valor_subtotal').val(subtotal);
			$('#valor_subtotal_text').html(subtotal);
		});
	}

	function addcheckedprodutoid(){
		var comma='';
		var product_id='';
		$('.produto').each(function(){
			var id=$(this).attr('id');
			//var amount=$('#amount'+id).val();
			id=id.replace('produto','');
			if ($(this).is(':checked')) {
				product_id=product_id+comma+id+':'+$('#amount'+id).val();
				comma=',';
			}
		});
		$('#products').val(product_id);
	}
});
	
</script>