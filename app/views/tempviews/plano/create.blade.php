<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<div class='container' >
	<h1>Create a new "plano"</h1>
	{[Form::open(array('url'=>URL::to('plano')))]}
		<div class="row">
			<div class="col-sm-2">
				nome
				<br>
				<input type="text" name="nome" id="nome" class='form-control'>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				descricao
				<br>
				<input type="text" name="descricao" id="descricao" class='form-control'>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				valor_total
				<br>
				<input type="text" name="valor_total" id="valor_total" class='form-control'>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				percentual_desconto
				<br>
				<input type="text" name="percentual_desconto" id="percentual_desconto" class='form-control'>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				validade_meses
				<br>
				<input type="text" name="validade_meses" id="validade_meses" class='form-control'>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				valiade_dias
				<br>
				<input type="text" name="valiade_dias" id="valiade_dias" class='form-control'>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				disponivel
				<br>
				<input type="text" name="disponivel" id="disponivel" class='form-control'>
			</div>
		</div>
		<br>
		<h3 class="muted">limite for current plano</h3>
		<div class="row">
			<div class="col-sm-2">
				motoristas
				<br>
				<input type="text" name="motoristas" id="motoristas" class='form-control'>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-2">
				caminhoes
				<br>
				<input type="text" name="caminhoes" id="caminhoes" class='form-control'>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				rastreamento
				<br>
				<input type="text" name="rastreamento" id="rastreamento" class='form-control'>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				cacambas
				<br>
				<input type="text" name="cacambas" id="cacambas" class='form-control'>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				NFSe
				<br>
				<input type="text" name="NFSe" id="NFSe" class='form-control'>
			</div>
		</div>
		<br>
		<br>
		<div class="row">
			<div class="col-sm-2">
				manutencao
				<br>
				<input type="text" name="manutencao" id="manutencao" class='form-control'>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				pagamentos
				<br>
				<input type="text" name="pagamentos" id="pagamentos" class='form-control'>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				fluxo_caixa
				<br>
				<input type="text" name="fluxo_caixa" id="fluxo_caixa" class='form-control'>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				relatorio_avancado
				<br>
				<input type="text" name="relatorio_avancado" id="relatorio_avancado" class='form-control'>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				benchmarks
				<br>
				<input type="text" name="benchmarks" id="benchmarks" class='form-control'>
			</div>
		</div>
		<br>
		<br>
		<input class='btn btn-primary' type="submit" value='create'>
		<br>
	{[Form::close()]}
	<a href="{[URL::to('plano') ]}">Back to plano index</a>


</div>