<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Edit produtofatura {[$id]} </h1>
		{[ Form::model($produtofatura, array('route' => array('produtofatura.update', $id), 'method' => 'PUT')) ]}
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
		<input type="submit" value='SAVE CHANGES'>
		{[Form::close()]}
		<br>
		<a href="{[URL::to('visibleprodutofatura')]}">go back to produtofatura index</a>
		<br>
		<br>
		<br>
	</div>
</body>
