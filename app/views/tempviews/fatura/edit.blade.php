<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>
			Edit fatura resource number {[$fatura->id]}
		</h1>
		<h3 class='text-danger'>
			Danger: you are about to edit a fatura.
			Be careful about changes you will apply.
		</h3>
		{[ Form::model($fatura, array('route' => array('fatura.update', $fatura->id), 'method' => 'PUT')) ]}
		<div class="row">
			<div class="col-sm-2">
				convenio_id
				<br>
				<input type="text" class='form-control' name="convenio_id" id="convenio_id" value="{[$fatura->convenio_id]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				mes_referencia
				<br>
				<input type="text" class='form-control' name="mes_referencia" id="mes_referencia" value="{[$fatura->mes_referencia]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				semestre_referencia
				<br>
				<input type="text" class='form-control' name="semestre_referencia" id="semestre_referencia" value="{[$fatura->semestre_referencia]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				ano_referencia
				<br>
				<input type="text" class='form-control' name="ano_referencia" id="ano_referencia" value="{[$fatura->ano_referencia]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				data_vencimento
				<br>
				<input type="text" class='form-control' name="data_vencimento" id="data_vencimento" value="{[$fatura->data_vencimento]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				data_pagamento
				<br>
				<input type="text" class='form-control' name="data_pagamento" id="data_pagamento" value="{[$fatura->data_pagamento]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				forma_pagamento
				<br>
				<input type="text" class='form-control' name="forma_pagamento" id="forma_pagamento" value="{[$fatura->forma_pagamento]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				status_pagamento
				<br>
				<input type="text" class='form-control' name="status_pagamento" id="status_pagamento" value="{[$fatura->status_pagamento]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				valor_plano
				<br>
				<input type="text" class='form-control' name="valor_plano" id="valor_plano" value="{[$fatura->valor_plano]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				valor_prod_compra
				<br>
				<input type="text" class='form-control' name="valor_prod_compra" id="valor_prod_compra" value="{[$fatura->valor_prod_compra]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				valor_prod_uso
				<br>
				<input type="text" class='form-control' name="valor_prod_uso" id="valor_prod_uso" value="{[$fatura->valor_prod_uso]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				valor_boleto
				<br>
				<input type="text" class='form-control' name="valor_boleto" id="valor_boleto" value="{[$fatura->valor_boleto]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				valor_total
				<br>
				<input type="text" class='form-control' name="valor_total" id="valor_total" value="{[$fatura->valor_total]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				ajuste_tipo
				<br>
				<input type="text" class='form-control' name="ajuste_tipo" id="ajuste_tipo" value="{[$fatura->ajuste_tipo]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				ajuste_valor
				<br>
				<input type="text" class='form-control' name="ajuste_valor" id="ajuste_valor" value="{[$fatura->ajuste_valor]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				ajuste_percentual
				<br>
				<input type="text" class='form-control' name="ajuste_percentual" id="ajuste_percentual" value="{[$fatura->ajuste_percentual]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				pagarme
				<br>
				<input type="text" class='form-control' name="pagarme" id="pagarme" value="{[$fatura->pagarme]}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				NFSe
				<br>
				<input type="text" class='form-control' name="NFSe" id="NFSe" value="{[$fatura->NFSe]}">
			</div>
		</div>
		<br>
		<input type="submit" value='SAVE CHANGES'>
		{[Form::close()]}
		<a href="{[URL::to('visiblefatura')]}">Back to fatura</a>
		<br>	
		<br>
	</div>
</body>

	
