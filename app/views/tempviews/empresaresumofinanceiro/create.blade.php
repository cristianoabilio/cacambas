<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>New resumofinanceiro</h1>
		{[Form::open(array('url'=>URL::to('empresa/'.$empresa_id.'/resumofinanceiro')) )]}
		<div class="row">
			<div class="col-sm-2">
				mes_referencia
				<br>
				<input type="text" class='form-control' name="mes_referencia" id="mes_referencia">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				ano_referencia
				<br>
				<input type="text" class='form-control' name="ano_referencia" id="ano_referencia">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				total_locacoes_colocada
				<br>
				<input type="text" class='form-control' name="total_locacoes_colocada" id="total_locacoes_colocada">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				total_locacoes_troca
				<br>
				<input type="text" class='form-control' name="total_locacoes_troca" id="total_locacoes_troca">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				total_locacoes_retirada
				<br>
				<input type="text" class='form-control' name="total_locacoes_retirada" id="total_locacoes_retirada">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				total_os_colocada
				<br>
				<input type="text" class='form-control' name="total_os_colocada" id="total_os_colocada">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				total_os_troca
				<br>
				<input type="text" class='form-control' name="total_os_troca" id="total_os_troca">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				total_os_retirada
				<br>
				<input type="text" class='form-control' name="total_os_retirada" id="total_os_retirada">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				total_recebimento_aberto
				<br>
				<input type="text" class='form-control' name="total_recebimento_aberto" id="total_recebimento_aberto">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				total_recebimento_recebido
				<br>
				<input type="text" class='form-control' name="total_recebimento_recebido" id="total_recebimento_recebido">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				total_recebimento_atrasado
				<br>
				<input type="text" class='form-control' name="total_recebimento_atrasado" id="total_recebimento_atrasado">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				total_despesa_imposto
				<br>
				<input type="text" class='form-control' name="total_despesa_imposto" id="total_despesa_imposto">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				total_despesa_pessoal
				<br>
				<input type="text" class='form-control' name="total_despesa_pessoal" id="total_despesa_pessoal">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				total_despesa_fixa
				<br>
				<input type="text" class='form-control' name="total_despesa_fixa" id="total_despesa_fixa">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				total_despesa_variavel
				<br>
				<input type="text" class='form-control' name="total_despesa_variavel" id="total_despesa_variavel">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				total_despesa_manutencao
				<br>
				<input type="text" class='form-control' name="total_despesa_manutencao" id="total_despesa_manutencao">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				total_fluxo_caixa
				<br>
				<input type="text" class='form-control' name="total_fluxo_caixa" id="total_fluxo_caixa">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				total_boletos_pagos
				<br>
				<input type="text" class='form-control' name="total_boletos_pagos" id="total_boletos_pagos">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				total_pagamentos_cartao
				<br>
				<input type="text" class='form-control' name="total_pagamentos_cartao" id="total_pagamentos_cartao">
			</div>
		</div>
		<br>
		<input type="submit" value='create'>
		{[Form::close()]}
		<a href="{[URL::to('empresa/'.$empresa_id.'/visibleresumofinanceiro')]}">Back to resumofinanceiro index</a>
		<br>
		<br>
		<br>
	</div>
		
</body>


