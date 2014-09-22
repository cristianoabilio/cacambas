<div style='margin-left:200px'>
	Add a new "fatura"

	<form action="{[URL::to('fatura')]}" method="post">

		convenio_id <input type="text" name="convenio_id" id="convenio_id"><br>
		mes_referencia <input type="text" name="mes_referencia" id="mes_referencia"><br>
		semestre_referencia <input type="text" name="semestre_referencia" id="semestre_referencia"><br>
		ano_referencia <input type="text" name="ano_referencia" id="ano_referencia"><br>
		data_vencimento <input type="text" name="data_vencimento" id="data_vencimento"><br>
		data_pagamento <input type="text" name="data_pagamento" id="data_pagamento"><br>
		forma_pagamento <input type="text" name="forma_pagamento" id="forma_pagamento"><br>
		status_pagamento <input type="text" name="status_pagamento" id="status_pagamento"><br>
		valor_plano <input type="text" name="valor_plano" id="valor_plano"><br>
		valor_prod_compra <input type="text" name="valor_prod_compra" id="valor_prod_compra"><br>
		valor_prod_uso <input type="text" name="valor_prod_uso" id="valor_prod_uso"><br>
		valor_boleto <input type="text" name="valor_boleto" id="valor_boleto"><br>
		valor_total <input type="text" name="valor_total" id="valor_total"><br>
		ajuste_tipo <input type="text" name="ajuste_tipo" id="ajuste_tipo"><br>
		ajuste_valor <input type="text" name="ajuste_valor" id="ajuste_valor"><br>
		ajuste_percentual <input type="text" name="ajuste_percentual" id="ajuste_percentual"><br>
		pagarme <input type="text" name="pagarme" id="pagarme"><br>
		NFSe <input type="text" name="NFSe" id="NFSe"><br>

		<br>
		<input type="submit" value='create'>
		<br>
		<a href="{[URL::to('fatura') ]}">Back to fatura index</a>
	</form>
</div>