<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div id="base" class="hide">{[URL::to('/')]}</div>
	<div class="container">
		<h1>Edit endereco record number {[$enderecoempresa->id]}</h1>
		<div id="current_data" class='hide'>
			<div id="estado_id">{[$enderecoempresa->endereco->enderecobase->bairro->cidade->estado->id]}</div>
			<div id="cidade_id">{[$enderecoempresa->endereco->enderecobase->bairro->cidade->id]}</div>
			<div id="bairro_id">{[$enderecoempresa->endereco->enderecobase->bairro->id]}</div>
			<!-- Before edit / update values on endereco table-->
			<div id="def_enderecobase_id">{[$enderecoempresa->endereco->enderecobase->id]}</div>
			<div id="def_numero">{[$enderecoempresa->endereco->numero]}</div>
			<div id="def_cep">{[$enderecoempresa->endereco->cep]}</div>
			<div id="def_latitude">{[$enderecoempresa->endereco->latitude]}</div>
			<div id="def_longitude">{[$enderecoempresa->endereco->longitude]}</div>
			<div id="def_restricao_hr_inicio">{[$enderecoempresa->endereco->restricao_hr_inicio]}</div>
			<div id="def_restricao_hr_fim">{[$enderecoempresa->endereco->restricao_hr_fim]}</div>
			<!-- Before edit / update values on enderecoempresa table-->
			<div id="def_endereco_id">{[$enderecoempresa->endereco_id]}</div>
			<div id="def_tipo">{[$enderecoempresa->tipo]}</div>
			<div id="def_complemento">{[$enderecoempresa->complemento]}</div>
			<div id="def_observacao">{[$enderecoempresa->observacao]}</div>
			<div id="def_status">{[$enderecoempresa->status]}</div>
		</div>
		Enderecoempresa located at
		<br>
		estado "{[$enderecoempresa->endereco->enderecobase->bairro->cidade->estado->nome]}"
		<a href="" id="change_estado">change</a>
		<div id="select_new_estado" class='select_new'>
			<div class="row">
				<div class="col-sm-2">
					estado
					<br>
					<select name="estado" id="estado" class='form-control'>
						<option value="{[$enderecoempresa->endereco->enderecobase->bairro->cidade->estado->id]}">{[$enderecoempresa->endereco->enderecobase->bairro->cidade->estado->nome]}</option>
						@foreach(Estado::all() as $e)
							<option value="{[$e->id]}">{[$e->nome]}</option>
						@endforeach
					</select>
					<a href="" id="cancel_new_estado">cancel</a>
				</div>
			</div>
					
		</div>
		<br>
		cidade "{[$enderecoempresa->endereco->enderecobase->bairro->cidade->nome]}"
		<a href="" id="change_cidade">change</a>
		<div id="select_new_cidade" class='select_new'>
			<div class="row">
				<div class="col-sm-2">
					new cidade
					<br>
					<select name="cidade" id="cidade" class='form-control'>
						<option value="{[$enderecoempresa->endereco->enderecobase->bairro->cidade->id]}">{[$enderecoempresa->endereco->enderecobase->bairro->cidade->nome]}</option>
						@foreach($enderecoempresa->endereco->enderecobase->bairro->cidade->estado->cidade as $c)
							<option value="{[$c->id]}">{[$c->nome]}</option>
						@endforeach
					</select>
					<a href="" id="cancel_new_cidade">cancel</a>
				</div>
			</div>
		</div>
		<br>
		bairro "{[$enderecoempresa->endereco->enderecobase->bairro->nome]}"
		<a href="" id="change_bairro">change</a>
		<div id="select_new_bairro" class='select_new'>
			<div class="row">
				<div class="col-sm-2">
					new bairro
					<br>
					<select name="bairro" id='bairro' class='form-control'>
						<option selected value="{[$enderecoempresa->endereco->enderecobase->bairro->id]}">{[$enderecoempresa->endereco->enderecobase->bairro->nome]}</option>
						@foreach($enderecoempresa->endereco->enderecobase->bairro->cidade->bairro as $b)
							<option value="{[$b->id]}">{[$b->nome]}</option>
						@endforeach
					</select>
					<a href="" id="cancel_new_bairro">cancel</a>
				</div>
			</div>
		</div>
		<br>

		{[ Form::model($enderecoempresa, array('route' => array('empresa.enderecoempresa.update', $empresa_id,$id), 'method' => 'PUT')) ]}
		enderecobase cep "{[$enderecoempresa->endereco->enderecobase->cep_base]}"
		<a href="" id="change_enderecobase">change</a>
		<div id="select_new_enderecobase" class='select_new'>
			<div class="row">
				<div class="col-sm-3">
					new enderecobase
					<br>
					<select name="enderecobase_id" id="enderecobase_id" class='form-control'>
						<option value="{[$enderecoempresa->endereco->enderecobase_id]}">{[$enderecoempresa->endereco->enderecobase->cep_base]}</option>
						@foreach($enderecoempresa->endereco->enderecobase->bairro->enderecobase as $eb)
							<option value="{[$eb->id]}">{[$eb->cep_base]}</option>
						@endforeach
					</select>
					<a href="" id="add_enderecobase">Add enderecobase (if not found on list)</a>
					<div id="add_enderecobase_form">
						<div class="text-warning">Warning: before saving verify that entered enderecobase matches with proper bairro, cidade and estado</div>
						<input type="text" placeholder='enderecobase cep' id='cep_base' class='form-control e_b'>
						<br>
						<input type="text" placeholder='logradouro' id='logradouro'class='form-control e_b'>
						<br>
						<input type="text" placeholder='regiao' id='regiao' class='form-control e_b'>
						<br>
						<input type="text" placeholder='numero inicio' id='numero_inicio' class='form-control e_b'>
						<br>
						<input type="text" placeholder='numero fim' id='numero_fim' class='form-control e_b'>
						<br>
						<input type="text" placeholder='restricao inicio' id='restricao_hr_inicio_base' class='form-control e_b'>
						<br>
						<input type="text" placeholder='restricao fim' id='restricao_hr_fim_base' class='form-control e_b'>
						<br>
						<button class='btn btn-default' id='new_enderecobase'>new enderecobase</button>
					</div>
					<br>
					<a href="" id="cancel_new_enderecobase">cancel</a>
				</div>
			</div>	
		</div>
		<h4>Endereco</h4>
		<div class="row">
			<div class="col-sm-2">
				numero
				<br>
				<input type="text" class='form-control endereco' name="numero" id="numero" value="{[$enderecoempresa->endereco->numero]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				cep
				<br>
				<input type="text" class='form-control endereco' name="cep" id="cep" value="{[$enderecoempresa->endereco->cep]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				latitude
				<br>
				<input type="text" class='form-control endereco' name="latitude" id="latitude" value="{[$enderecoempresa->endereco->latitude]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				longitude
				<br>
				<input type="text" class='form-control endereco' name="longitude" id="longitude" value="{[$enderecoempresa->endereco->longitude]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				restricao_hr_inicio
				<br>
				<input type="text" class='form-control endereco' name="restricao_hr_inicio" id="restricao_hr_inicio" value="{[$enderecoempresa->endereco->restricao_hr_inicio]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				restricao_hr_fim
				<br>
				<input type="text" class='form-control endereco' name="restricao_hr_fim" id="restricao_hr_fim" value="{[$enderecoempresa->endereco->restricao_hr_fim]}">
			</div>
		</div>
		<br>

		<h4>Enderecoempresa</h4>

		<div class="row">
			<div class="col-sm-2">
				tipo
				<br>
				<input type="text" class='form-control' name="tipo" id="tipo" value="{[$enderecoempresa->tipo]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				complemento
				<br>
				<input type="text" class='form-control' name="complemento" id="complemento" value="{[$enderecoempresa->complemento]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				observacao
				<br>
				<input type="text" class='form-control' name="observacao" id="observacao" value="{[$enderecoempresa->observacao]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				status
				<br>
				<input type="text" class='form-control' name="status" id="status" value="{[$enderecoempresa->status]}">
			</div>
		</div>
		<br>
		<input type="submit" value='SAVE CHANGES'>
		<br>
		{[Form::close()]}
		<br>
		{[ Form::model($enderecoempresa, array('route' => array('empresa.enderecoempresa.destroy', $empresa_id,$id), 'method' => 'DELETE')) ]}
			<input type="submit" value='DELETE'>
		{[Form::close()]}
		<br>
		<a href="{[URL::to('empresa/'.$empresa_id.'/visibleenderecoempresa') ]}">Back to enderecoempresa index</a>
		<br>
		<br>
	</div>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</body>	
<script type="text/javascript">
$(function(){
	$('.select_new').hide();
	
	$('#change_estado').click(function(e){
			e.preventDefault();
			$('#select_new_estado').show('fast');
		});
	$('#change_cidade').click(function(e){
		e.preventDefault();
		$('#select_new_cidade').show('fast');
	});
	$('#change_bairro').click(function(e){
		e.preventDefault();
		$('#select_new_bairro').show('fast');
	});
	$('#change_enderecobase').click(function(e){
		e.preventDefault();
		$('#select_new_enderecobase').show('fast');
	});

	$('#cancel_new_enderecobase').click(function(e){
		e.preventDefault();
		$('#enderecobase_id').val( $('#def_enderecobase_id').text()  );
		$('#select_new_enderecobase').hide('fast');
		$('#add_enderecobase_form').hide('fast');
		restoreenderecoval();
	});

	$('#estado').click(function(){
		var estado=$('#estado').val();
		if ( estado != $('#estado_id').text() ) {
			$('.endereco').val('');
			$('#select_new_cidade').show('fast');
			$('#select_new_bairro').show('fast');
			$('#select_new_enderecobase').show('fast');
		} else {
			var current_bairro_id=$('#bairro_id').text();
			var cidade=$('#cidade_id').text();
			restoreenderecoval();
			adjustenderecobaseonbairro(estado,cidade,current_bairro_id);
			adjust_bairro_on_cidade(estado,cidade);
			$('#select_new_cidade').hide('fast');
			$('#select_new_bairro').hide('fast');
			$('#select_new_enderecobase').hide('fast');
		}
		adjust_cidade_on_estado(estado);
	});

	$('#cancel_new_estado').click(function(e){
		e.preventDefault();
		restoreenderecoval();
		var estado=$('#estado_id').text();
		var cidade=$('#cidade_id').text();
		var current_bairro_id=$('#bairro_id').text();
		$('#estado').val(estado);
		$('#select_new_enderecobase').hide('fast');
		$('#select_new_bairro').hide('fast');
		$('#select_new_cidade').hide('fast');
		$('#select_new_estado').hide('fast');
		adjustenderecobaseonbairro(estado,cidade,current_bairro_id);
		adjust_bairro_on_cidade(estado,cidade);
		adjust_cidade_on_estado(estado);
		
	});

	$('#cidade').change(function(e){
		var estado=$('#estado').val();
		var cidade=$('#cidade').val();
		if ( cidade != $('#cidade_id').text() ) {
			$('.endereco').val('');
			$('#select_new_bairro').show('fast');
			$('#select_new_enderecobase').show('fast');
		} else {
			restoreenderecoval();
			var current_bairro_id=$('#bairro_id').text();
			adjustenderecobaseonbairro(estado,cidade,current_bairro_id);
			$('#bairro').val(current_bairro_id);
			$('#select_new_bairro').hide('fast');
			$('#select_new_enderecobase').hide('fast');
		}
		adjust_bairro_on_cidade(estado,cidade);
	});

	function adjust_cidade_on_estado(estado){
		$('#enderecobase_id').html('');
		$('#bairro').html('');
		var current_cidade=$('#cidade_id').text();
		var base=$('#base').html();
		$.get(
			base+'/estado/'+estado+'/cidade/',
			{},
			function(d){
				var options='<option val=""></option>';
				$.each(d,function(k,v){
					if (current_cidade==v.id) {
						selected=' selected ';
						$('#cidade').val(v.id);
					} else {
						selected='';
					}
					options=options+'<option value="'+v.id+'" '+selected+' >'+v.nome+'</option>';
				}
				)
				;
				$('#cidade').html('');
				$('#cidade').append(options);
				$('#cidade').val(current_cidade);
			}
			)
		;
	}

	function adjust_bairro_on_cidade(estado,cidade) {
		$('#enderecobase_id').html('');
		var current_bairro=$('#bairro_id').text();
		var base=$('#base').html();
		$.get(
			base+'/estado/'+estado+'/cidade/'+cidade+'/bairro',
			{},
			function(d){
				var options='<option val=""></option>';
				$.each(d,function(k,v){
					if (current_bairro==v.id) {
						selected=' selected ';
						$('#bairro').val(v.id);
					} else {
						selected='';
					}
					options=options+'<option value="'+v.id+'" '+selected+' >'+v.nome+'</option>';
				}
				)
				;
				$('#bairro').html('');
				$('#bairro').append(options);
				$('#bairro').val(current_bairro);
			}
			)
		;
	}

	$('#cancel_new_cidade').click(function(e){
		e.preventDefault();
		restoreenderecoval();
		var estado=$('#estado_id').text();
		var cidade=$('#cidade_id').text();
		var current_bairro_id=$('#bairro_id').text();
		$('#cidade').val(cidade);
		$('#select_new_enderecobase').hide('fast');
		$('#select_new_bairro').hide('fast');
		$('#select_new_cidade').hide('fast');
		adjustenderecobaseonbairro(estado,cidade,current_bairro_id);
		adjust_bairro_on_cidade(estado,cidade);
	});

	$('#bairro').change(function(e){
		var estado=$('#estado').val();
		var cidade=$('#cidade').val();
		var bairro_id=$(this).val();

		//If bairro value changes
		if ( bairro_id != $('#bairro_id').text() ) {
			$('.endereco').val('');
			$('#select_new_enderecobase').show('fast');
		} else {
			restoreenderecoval();
		}
		adjustenderecobaseonbairro(estado,cidade,bairro_id);
	});

	$('#cancel_new_bairro').click(function(e){
		e.preventDefault();
		restoreenderecoval();
		var estado=$('#estado_id').text();
		var cidade=$('#cidade_id').text();
		var current_bairro_id=$('#bairro_id').text();
		//var current_enderecobase=$('#def_enderecobase_id').text();
		$('#bairro').val(current_bairro_id);
		$('#select_new_enderecobase').hide('fast');
		$('#select_new_bairro').hide('fast');
		adjustenderecobaseonbairro(estado,cidade,current_bairro_id);
		}
		)
	;

	$('#add_enderecobase_form').hide();

	$('#add_enderecobase').click(function(e){
		e.preventDefault();
		$('#add_enderecobase_form').show('fast');
	});

	$('#new_enderecobase').click(function(e){
		e.preventDefault();
		//URI parameters
		var estado=$('#estado').val();
		var cidade=$('#cidade').val();
		var bairro=$('#bairro').val();
		//
		//Controller parameters
		var cep_base=$('#cep_base').val();
		var logradouro=$('#logradouro').val();
		var regiao=$('#regiao').val();
		var numero_inicio=$('#numero_inicio').val();
		var numero_fim=$('#numero_fim').val();
		var restricao_hr_inicio_base=$('#restricao_hr_inicio_base').val();
		var restricao_hr_fim_base=$('#restricao_hr_fim_base').val();
		//
		var base=$('#base').html();
		//
		$.post(
			base+'/estado/'+estado+'/cidade/'+cidade+'/bairro/'+bairro+'/enderecobase',
			{
				cep_base:cep_base,
				logradouro:logradouro,
				regiao:regiao,
				numero_inicio:numero_inicio,
				numero_fim:numero_fim,
				restricao_hr_inicio_base:restricao_hr_inicio_base,
				restricao_hr_fim_base:restricao_hr_fim_base
			},
			function(d){
				$.each(d,function(k,v){
					$('#enderecobase_id').html('').append(
						'<option value="'+v.id+'">'+cep_base+
						'</option>'
						)
					;
				});
				$('.e_b').val('');
				$('#add_enderecobase_form').hide('fast');
			}
			);
	});
	//

	function adjustenderecobaseonbairro(estado,cidade,bairro){
		var current_enderecobase=$('#def_enderecobase_id').text();
		var base=$('#base').html();
		$.get(
			base+'/estado/'+estado+'/cidade/'+cidade+'/bairro/'+bairro+'/enderecobase',
			{},
			function(d){
				var options='<option></option>';
				$.each(d,function(k,v){
					if (current_enderecobase==v.id) {
						selected=' selected ';
					} else {
						selected='';
					}
					options=options+'<option value="'+v.id+'" '+selected+' >'+v.cep_base+'</option>';
				}
				)
				;
				$('#enderecobase_id').html('');
				$('#enderecobase_id').append(options);
			}
			)
		;
	}

	$('#enderecobase_id').change(function(e){
		if ( $(this).val()!= $('#def_enderecobase_id').text() ) {
			$('.endereco').val('');
		} else {
			restoreenderecoval();
		}
	});

	function restoreenderecoval(){
		$('.endereco').each(function(){
			var id=$(this).attr('id');
			prev_val=$('#def_'+id).text();
			$(this).val(prev_val);
		});
	}
});
</script>