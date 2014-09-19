Edit 
{[$fatura->IDEmpresa]}
<br>
<br>	
<div style='margin-left:200px'>
	
	{[ Form::model($fatura, array('route' => array('fatura.update', $fatura->IDFatura), 'method' => 'PUT')) ]}


		IDConvenio <input type="text" name="IDConvenio" id="IDConvenio" value="{[$fatura->IDFatura]}">	<br>
		IDEmpresa <input type="text" name="IDEmpresa" id="IDEmpresa" value="{[$fatura->IDEmpresa]}">	<br>
		mes_referencia <input type="text" name="mes_referencia" id="mes_referencia" value="{[$fatura->mes_referencia]}">	<br>
		semestre_referencia <input type="text" name="semestre_referencia" id="semestre_referencia" value="{[$fatura->semestre_referencia]}">	<br>
		ano_referencia <input type="text" name="ano_referencia" id="ano_referencia" value="{[$fatura->ano_referencia]}">	<br>
		data_vencimento <input type="text" name="data_vencimento" id="data_vencimento" value="{[$fatura->data_vencimento]}">	<br>
		data_pagamento <input type="text" name="data_pagamento" id="data_pagamento" value="{[$fatura->data_pagamento]}">	<br>
		forma_pagamento <input type="text" name="forma_pagamento" id="forma_pagamento" value="{[$fatura->forma_pagamento]}">	<br>
		status_pagamento <input type="text" name="status_pagamento" id="status_pagamento" value="{[$fatura->status_pagamento]}">	<br>
		valor_plano <input type="text" name="valor_plano" id="valor_plano" value="{[$fatura->valor_plano]}">	<br>
		valor_prod_compra <input type="text" name="valor_prod_compra" id="valor_prod_compra" value="{[$fatura->valor_prod_compra]}">	<br>
		valor_prod_uso <input type="text" name="valor_prod_uso" id="valor_prod_uso" value="{[$fatura->valor_prod_uso]}">	<br>
		valor_boleto <input type="text" name="valor_boleto" id="valor_boleto" value="{[$fatura->valor_boleto]}">	<br>
		valor_total <input type="text" name="valor_total" id="valor_total" value="{[$fatura->valor_total]}">	<br>
		ajuste_tipo <input type="text" name="ajuste_tipo" id="ajuste_tipo" value="{[$fatura->ajuste_tipo]}">	<br>
		ajuste_valor <input type="text" name="ajuste_valor" id="ajuste_valor" value="{[$fatura->ajuste_valor]}">	<br>
		ajuste_percentual <input type="text" name="ajuste_percentual" id="ajuste_percentual" value="{[$fatura->ajuste_percentual]}">	<br>
		pagarme <input type="text" name="pagarme" id="pagarme" value="{[$fatura->pagarme]}">	<br>
		NFSe <input type="text" name="NFSe" id="NFSe" value="{[$fatura->NFSe]}">	<br>
		dthr_cadastro <input type="text" name="dthr_cadastro" id="dthr_cadastro" value="{[$fatura->dthr_cadastro]}">	<br>
		IDSessao <input type="text" name="IDSessao" id="IDSessao" value="{[$fatura->IDSessao]}">	<br>


		<br>
		<br>
		<input type="submit" value='SAVE CHANGES'>
	</form>

<a href="{[URL::to('fatura')]}">Back to fatura</a>
</div>