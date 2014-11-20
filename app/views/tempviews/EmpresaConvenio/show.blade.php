<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Displaying data for convenio number {[$id]} on empresa {[Empresa::find($empresa_id)->nome]}</h1>
		<div class="text-muted">
			<h3>Plano for current convenio</h3>
			<div class="row">
				<div class="col-sm-2">Nome</div>
				<div class="col-sm-6">{[$convenio->plano->nome]}</div>
			</div>
			<div class="row">
				<div class="col-sm-2">descricao</div>
				<div class="col-sm-6">{[$convenio->plano->descricao]}</div>
			</div>
			<div class="row">
				<div class="col-sm-2">valor_total</div>
				<div class="col-sm-6">{[$convenio->plano->valor_total]}</div>
			</div>
			<div class="row">
				<div class="col-sm-2">percentual_desconto</div>
				<div class="col-sm-6">{[$convenio->plano->percentual_desconto]}</div>
			</div>
			<div class="row">
				<div class="col-sm-2">validade_meses</div>
				<div class="col-sm-6">{[$convenio->plano->validade_meses]}</div>
			</div>
			<div class="row">
				<div class="col-sm-2">valiade_dias</div>
				<div class="col-sm-6">{[$convenio->plano->valiade_dias]}</div>
			</div>
			<div class="row">
				<div class="col-sm-2">disponivel</div>
				<div class="col-sm-6">{[$convenio->plano->disponivel]}</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-2">dia_fatura</div>
			<div class="col-sm-6">{[$convenio->dia_fatura   ]}</div>
		</div>
		<div class="row">
			<div class="col-sm-2">tipo_pagamento</div>
			<div class="col-sm-6">{[$convenio->tipo_pagamento   ]}</div>
		</div>
		<div class="row">
			<div class="col-sm-2">dt_inicio</div>
			<div class="col-sm-6">{[$convenio->dt_inicio   ]}</div>
		</div>
		<div class="row">
			<div class="col-sm-2">dt_fim</div>
			<div class="col-sm-6">{[$convenio->dt_fim   ]}</div>
		</div>
		<div class="text-muted">
			<h3>Limite for current convenio</h3>
			<?php  
			if ($convenio->limite_id==null) {
				$limites=$convenio->plano->limite;
			} else {
				$limites=$convenio->limite;
			}
			
			?>
			<div class="row">
				<div class="col-sm-2">motoristas</div>
				<div class="col-sm-6">{[$limites->motoristas   ]}</div>
			</div>
			<div class="row">
				<div class="col-sm-2">caminhoes</div>
				<div class="col-sm-6">{[$limites->caminhoes   ]}</div>
			</div>
			<div class="row">
				<div class="col-sm-2">rastreamento</div>
				<div class="col-sm-6">{[$limites->rastreamento   ]}</div>
			</div>
			<div class="row">
				<div class="col-sm-2">cacambas</div>
				<div class="col-sm-6">{[$limites->cacambas   ]}</div>
			</div>
			<div class="row">
				<div class="col-sm-2">NFSe</div>
				<div class="col-sm-6">{[$limites->NFSe   ]}</div>
			</div>
			<div class="row">
				<div class="col-sm-2">manutencao</div>
				<div class="col-sm-6">{[$limites->manutencao   ]}</div>
			</div>
			<div class="row">
				<div class="col-sm-2">pagamentos</div>
				<div class="col-sm-6">{[$limites->pagamentos   ]}</div>
			</div>
			<div class="row">
				<div class="col-sm-2">fluxo_caixa</div>
				<div class="col-sm-6">{[$limites->fluxo_caixa   ]}</div>
			</div>
			<div class="row">
				<div class="col-sm-2">relatorio_avancado</div>
				<div class="col-sm-6">{[$limites->relatorio_avancado   ]}</div>
			</div>
			<div class="row">
				<div class="col-sm-2">benchmarks</div>
				<div class="col-sm-6">{[$limites->benchmarks   ]}</div>
			</div>
			<a href="{[URL::to('empresa/'.$empresa_id.'/convenio/'.$id.'/edit')]} "> 
				....  Edit .... 
			</a>
		<br>
		{[ Form::model($convenio, array('route' => array('empresa.convenio.destroy', $empresa_id,$id), 'method' => 'DELETE')) ]}
		<input type="submit" value='DELETE' class='btn btn-link'>
		{[Form::close()]}
		<br>
		<a href="{[URL::to('empresa/'.$empresa_id.'/visibleconvenio') ]}">Back to convenio index</a>
		<br>
		<br>
		<br>
		</div>
	</div>
</body>

		
