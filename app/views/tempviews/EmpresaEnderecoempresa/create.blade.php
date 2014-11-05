<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div id="base" class="hide">{[URL::to('/')]}</div>
	<div class="container">
		<h1>
			Add a new enderecoempresa to empresa {[Empresa::find($id)->nome]}
		</h1>
		In order to properly add a new enderecoempresa, next order must be followed
		as each enderecoempresa belongs, in the mentioned hierachy, to
		<br>estado > cidade > bairro > enderecobase > endereco > enderecoempresa
		<br>
		<div class="row">
			<div class="col-sm-3">
				Estado
				<br>
				<select name="estado" id="estado" class='form-control'>
					<option value=""></option>
					@foreach(Estado::all() as $e)
					<option value="{[$e->id]}">{[$e->nome]} ({[$e->regiao]})</option>
					@endforeach
				</select>
			</div>
		</div>
		<br>
		<div id="cidade_tag">
			<div class="row">
				<div class="col-sm-3">
					Cidade
					<br>
					<select name="cidade" id="cidade" class='form-control'>
					</select>
					<a href="">Add cidade to list</a>
				</div>
			</div>
		</div>
		<br>
		<div id="bairro_tag">
			<div class="row">
				<div class="col-sm-3">
					bairro
					<br>
					<select name="bairro" id="bairro" class='form-control'></select>
					<a href="">Add bairro to list</a>
				</div>
			</div>
		</div>
		{[Form::open(array('url'=>URL::to('empresa/'.$id.'/enderecoempresa')  )  )]}
		<h3 class="muted">Endereco</h3>
		<div id="enderecobase_tag">
			<div class="row">
				<div class="col-sm-3">
					enderecobase
					<br>
					<select name="enderecobase_id" id="enderecobase_id" class='form-control'></select>
					<a href="">Add enderecobase to list</a>
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				numero
				<br>
				<input type="text" name="numero" id="numero" class='form-control'>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-2">
				cep
				<br>
				<input type="text" name="cep" id="cep" class='form-control'>
			</div>
		</div>
		<br>
		<br>
		<div class="row">
			<div class="col-sm-2">
				latitude
				<br>
				<input type="text" name="latitude" id="latitude" class='form-control'>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				longitude
				<br>
				<input type="text" name="longitude" id="longitude" class='form-control'>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-2">
				restricao_hr_inicio
				<br>
				<input type="text" name="restricao_hr_inicio" id="restricao_hr_inicio" class='form-control'>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				restricao_hr_fim
				<br>
				<input type="text" name="restricao_hr_fim" id="restricao_hr_fim" class='form-control'>
			</div>
		</div>
		<br>
		<hr>
		<h3 class="muted">Enderecoempresa</h3>
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
		<div class="row">
			<div class="col-sm-2">
				status
				<br>
				<input type="text" name="status" id="status" class='form-control'>
			</div>
		</div>
		<br>
		<input type="submit" value='create'>
		{[Form::close()]}
		<br>
		<a href="{[URL::to('empresa/'.$id.'/visibleenderecoempresa') ]}">Back to enderecoempresa index</a>
		<br>
		<br>
		<br>
	</div>
	<!-- 
	TEMPORARY JQUERY METHODS FOR DAY/SEMESTER/YEAR INVOICE OPTIONS
	DIA / SEMESTER / ANO
	-->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</body>
<script type="text/javascript">
$(function(){
	$('#cidade_tag').hide();

	$('#estado').change(function(e){
		var estado=$(this).val();
		if ( estado!='' ) {
			$('#cidade').html('');
			$('#cidade_tag').show('fast');
			var base=$('#base').html();
			$.get(base+'/estado/'+estado+'/cidade',{},function(d){
				var options='<option></option>';
				$.each(d,function(k,v){
					options=options+'<option value="'+v.id+'">'+v.nome+'</option>';
				});
				$('#cidade').append(options);
			});
		} else {
			$('#cidade_tag').hide('fast');
			$('#cidade').html('');
		}
		
	});


	$('#bairro_tag').hide();

	$('#cidade').change(function(e){
		var estado=$('#estado').val();
		var cidade=$(this).val();
		if ( cidade!='' ) {
			$('#bairro').html('');
			$('#bairro_tag').show('fast');
			var base=$('#base').html();
			$.get(base+'/estado/'+estado+'/cidade/'+cidade+'/bairro',{},function(d){
				var options='<option></option>';
				$.each(d,function(k,v){
					options=options+'<option value="'+v.id+'">'+v.nome+'</option>';
				});
				$('#bairro').append(options);
			});
		} else {
			$('#bairro_tag').hide('fast');
			$('#bairro').html('');
		}
		
	});



	$('#enderecobase_tag').hide();

	$('#bairro').change(function(e){
		var estado=$('#estado').val();
		var cidade=$('#cidade').val();
		var bairro=$(this).val();
		if ( bairro!='' ) {
			$('#enderecobase_id').html('');
			$('#enderecobase_tag').show('fast');
			var base=$('#base').html();
			$.get(
				base+'/estado/'+estado+'/cidade/'+cidade+
				'/bairro/'+bairro+'/enderecobase/',
				{},
				function(d){
					var options='<option></option>';
					$.each(d,function(k,v){
						options=options+'<option value="'+v.id+'">'+v.cep_base+'</option>';
					});
					$('#enderecobase_id').append(options);
				}
				)
			;
		} else {
			$('#enderecobase_tag').hide('fast');
			$('#enderecobase_id').html('');
		}
	});

});

</script>