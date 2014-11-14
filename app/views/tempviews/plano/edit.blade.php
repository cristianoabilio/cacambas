<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Edit <b class="text-info"> "{[$plano->nome]}"</b> plan</h1>
		{[ Form::model($plano, array('route' => array('plano.update', $plano->id), 'method' => 'PUT')) ]}
			<div class="row">
				<div class="col-sm-2">
					nome
					<br>
					<input type="text" name="nome" id="nome" value="{[$plano->nome]}" class='form-control'>
				</div>
			</div>
			<br><div class="row">
				<div class="col-sm-2">
					descricao
					<br>
					<input type="text" name="descricao" id="descricao" value="{[$plano->descricao]}" class='form-control'>
				</div>
			</div>
			<br><div class="row">
				<div class="col-sm-2">
					valor_total
					<br>
					<input type="text" name="valor_total" id="valor_total" value="{[$plano->valor_total]}" class='form-control'>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2">
					percentual_desconto
					<br>
					<input type="text" name="percentual_desconto" id="percentual_desconto" value="{[$plano->percentual_desconto]}" class='form-control'>
				</div>
				<div class="col-sm-6"></div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2">
					validade_meses
					<br>
					<input type="text" name="validade_meses" id="validade_meses" value="{[$plano->validade_meses]}" class='form-control'>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2">
					valiade_dias
					<br>
					<input type="text" name="valiade_dias" id="valiade_dias" value="{[$plano->valiade_dias]}" class='form-control'>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2">
					disponivel
					<br>
					<input type="text" name="disponivel" id="disponivel" value="{[$plano->disponivel]}" class='form-control'>
				</div>
			</div>
			<hr>
			<h3 class="muted">Limite for this plano</h3>
			<div class="row">
				<div class="col-sm-2">
					motoristas
					<br>
					<input type="text" name="motoristas" id="motoristas" value="{[$plano->limite->motoristas]}" class='form-control'>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2">
					caminhoes
					<br>
					<input type="text" name="caminhoes" id="caminhoes" value="{[$plano->limite->caminhoes]}" class='form-control'>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2">
					rastreamento
					<br>
					<input type="text" name="rastreamento" id="rastreamento" value="{[$plano->limite->rastreamento]}" class='form-control'>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2">
					cacambas
					<br>
					<input type="text" name="cacambas" id="cacambas" value="{[$plano->limite->cacambas]}" class='form-control'>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2">
					NFSe
					<br>
					<input type="text" name="NFSe" id="NFSe" value="{[$plano->limite->NFSe]}" class='form-control'>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2">
					manutencao
					<br>
					<input type="text" name="manutencao" id="manutencao" value="{[$plano->limite->manutencao]}" class='form-control'>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2">
					pagamentos
					<br>
					<input type="text" name="pagamentos" id="pagamentos" value="{[$plano->limite->pagamentos]}" class='form-control'>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2">
					fluxo_caixa
					<br>
					<input type="text" name="fluxo_caixa" id="fluxo_caixa" value="{[$plano->limite->fluxo_caixa]}" class='form-control'>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2">
					relatorio_avancado
					<br>
					<input type="text" name="relatorio_avancado" id="relatorio_avancado" value="{[$plano->limite->relatorio_avancado]}" class='form-control'>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2">
					benchmarks
					<br>
					<input type="text" name="benchmarks" id="benchmarks" value="{[$plano->limite->benchmarks]}" class='form-control'>
				</div>
			</div>
			<br>
			<input type="submit" class='btn btn-primary' value='SAVE CHANGES'>
		{[Form::close()]}
		<hr>
		{[ Form::model($plano, array('route' => array('plano.destroy', $plano->id), 'method' => 'DELETE')) ]}
		<input type="submit" value='DELETE'>
	{[Form::close()]}
		<br>
		<a href="{[URL::to('visibleplano')]}">Back to plano</a>
	</div>
</body>