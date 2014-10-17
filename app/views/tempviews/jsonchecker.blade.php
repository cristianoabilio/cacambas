<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>JSON checker</title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div id="base" class='hide'>{[URL::to('/')]}</div>
	<div class="container">
		<h1>JSON checker <spam class="text-muted">- temporary view -</spam></h1>
		If text is generated it means a json object was succesfully returned
		<br>
		<br>
		first test
		<div id="test2"></div>
		<br>
		<br>
		Second test
		<?php  
		
		$routes=array(
			'compras',
			'contabancaria',
			'convenio',
			'empresa',
			'endereco',
			'fatura',
			'limite',
			'plano',
			'produto',
			'resumoatividade',
			'resumoempresacliente',
			'resumofinanceiro',
			'funcionario',
			'bairro',
			'cidade',
			'estado'
			);
		?>
		@foreach($routes as $r)
			<div class="row rowtester" id='rowtester{[$r]}'>
				<div class="col-sm-12">
					Route= /{[$r]}
					<br>
					RESTful action: index
					<br>
					<button id='test{[$r]}' class="btn btn-default">Test</button>
					<button id='clear{[$r]}' class="btn btn-default">Clear</button>
					<br>
					Response
					<div id="jsonresponse{[$r]}"></div>
				</div>
			</div>
			<hr>
		@endforeach
	</div>
</body>
<!-- 
TEMPORARY JQUERY METHODS FOR DAY/SEMESTER/YEAR INVOICE OPTIONS
DIA / SEMESTER / ANO
-->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
$(function(){
	function jsontester(object,id){
		var collector='';
		var collector2='';
		$.each(object,function(k,v){
			$.each(v,function(k2,v2){
				collector2=collector2+'/'+k2+':'+v2;
			});
			collector=collector+' - '+k+':'+collector2+'<hr>';
		} );
		$('#'+id).html('json data: '+collector);
	}

	$('.rowtester').each(function(){
		var id=$(this).attr('id');
		id=id.replace('rowtester','');
		//Put here functions for html elements with mentioned class
		jsonchecker(id);
	});

	function jsonchecker(id) {
		$('#test'+id).click(function(e){
			var base=$('#base').html();
			e.preventDefault();
			$.getJSON(
				base+'/'+id,
				function(d){
					djson=eval(d);
					jsontester(djson,'jsonresponse'+id);
				}
				)
			;
		});

		$('#clear'+id).click(function(e){
			e.preventDefault();
			$('#jsonresponse'+id).html('');
		});
	}

	

		

	
});
</script>