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
					data_compra 
					<br>
					{[$today]}
					<input type="hidden" class='form-control' name="data_compra" id="data_compra" value="{[date('Y-m-d')]}">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2">
					data_vencimiento 
					<br>
					{[$expire]}
					<input type="hidden" class='form-control' name="data_vencimiento" id="data_vencimiento"  value="{[date('Y-m-d')]}">
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
							<input type="text" id='amount{[$p->id]}' class="form-control" value='0'>
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
							<spam id="total{[$p->id]}">0</spam>
							<hr>
						</div>
					</div>
				</div>
				
			@endforeach
			<input type="hidden" id="products" name='products'>
			
			<br>
			<div class="row">
				<div class="col-sm-2">
					valor_subtotal 
					<spam id="valor_subtotal_text"></spam>
					<br>
					<input type="hidden" class='form-control' name="valor_subtotal" id="valor_subtotal">
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
					<spam class="text-muted">discount in percent - enter number between 1 and 100</spam>
					<br>
					<input type="text" class='form-control' name="valor_ajuste_percentual" id="valor_ajuste_percentual">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2">
					valor_total
					<spam id="valor_total_text"></spam>
					<br>
					<input type="hidden" class='form-control' name="valor_total" id="valor_total">
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
		<a href="{[URL::to('empresa/'.$empresa_id.'/convenio/'.$convenio_id.'/visibleprodutofatura') ]}">Back to produtofatura index</a>
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
				sumtotal();
				addcheckedprodutoid();
			});
		});

		hmdfloatnumb($('#valor_ajuste_percentual'));

		validrangenumber(0,100,'valor_ajuste_percentual');

		$('#valor_ajuste_percentual').keyup(function(){
			//
			sumtotal();
		});

		function sumsubtotal(){
			var subtotal=0;
			$('.produto').each(function(){
				//
				var id=$(this).attr('id');
				id=id.replace('produto','');
				subtotal=subtotal+parseInt($('#total'+id).html(),10);
				if (subtotal>0) {
					$('#valor_subtotal').val(subtotal);
					$('#valor_subtotal_text').html(subtotal);
				} else {
					$('#valor_subtotal').val('');
					$('#valor_subtotal_text').html('');
				}
				
			});
		}

		function sumtotal() {
			var subtotal=$('#valor_subtotal').val();
			var percent=$('#valor_ajuste_percentual').val();
			var total=subtotal*(1-percent/100);
			$('#valor_total_text').html(total);
			$('#valor_total').val(total);
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

		function hmdoccurrences(string, subString, allowOverlapping){

			string+=""; subString+="";
			if(subString.length<=0) return string.length+1;

			var n=0, pos=0;
			var step=(allowOverlapping)?(1):(subString.length);

			while(true){
				pos=string.indexOf(subString,pos);
				if(pos>=0){ n++; pos+=step; } else break;
			}
				return(n);
		}

		function hmdfloatnumb(id) {
	        $(id).keydown(function(event) {
		        var value = $(this).val();
		            
		            // Allow: backspace, delete, tab, escape, enter, minus (-) and .
		        if ( $.inArray(event.keyCode,[46,8,9,27,13,56,190,173,189,109,110]) !== -1 ||
		             // Allow: Ctrl+A
		            (event.keyCode == 65 && event.ctrlKey === true) || 
		             // Allow: home, end, left, right
		            (event.keyCode >= 35 && event.keyCode <= 39)) {
		                 // let it happen, don't do anything
		                 return;
		        }
		        else {
		            // Ensure that it is a number and stop the keypress
		            if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
		                event.preventDefault(); 
		            }   
		        }
		    });
		    $(id).keyup(function(e){
		        var value=$(this).val();
		        var minus=value.indexOf("-");
		        var minusduplicated=hmdoccurrences(value, "-");
		        var period=hmdoccurrences(value, ".");
		        if (minus>0||period>1||minusduplicated>1) {
		            $(this).val(value.substring(0,value.length - 1));
		        }
		    });
	    }

	    function validrangenumber(min,max,id) {
	    	$('#'+id).keyup(function(e){
	    		//e.preventDefault();
	    		if ( $(this).val().trim()<min ) {
	    			$(this).val('');
	    		} else if ($(this).val().trim()>max) {
	    			$(this).val('');
	    		}
	    	});
	    }
	});
</script>