<?php  
$fake=new fakeuser;
?>
Edit 
{[ Empresa::find($fake->empresa())->nome]}
<br>
BR	
<div style='margin-left:200px'>
	
	{[ Form::model($resumofinanceiro, array('route' => array('resumofinanceiro.update', $resumofinanceiro->id), 'method' => 'PUT')) ]}
		mes_referencia <input type="text" name="mes_referencia" id="mes_referencia" value="{[$resumofinanceiro->mes_referencia]}">	<br>
		ano_referencia <input type="text" name="ano_referencia" id="ano_referencia" value="{[$resumofinanceiro->ano_referencia]}">	<br>
		total_locacoes_colocada <input type="text" name="total_locacoes_colocada" id="total_locacoes_colocada" value="{[$resumofinanceiro->total_locacoes_colocada]}">	<br>
		total_locacoes_troca <input type="text" name="total_locacoes_troca" id="total_locacoes_troca" value="{[$resumofinanceiro->total_locacoes_troca]}">	<br>
		total_locacoes_retirada <input type="text" name="total_locacoes_retirada" id="total_locacoes_retirada" value="{[$resumofinanceiro->total_locacoes_retirada]}">	<br>
		total_os_colocada <input type="text" name="total_os_colocada" id="total_os_colocada" value="{[$resumofinanceiro->total_os_colocada]}">	<br>
		total_os_troca <input type="text" name="total_os_troca" id="total_os_troca" value="{[$resumofinanceiro->total_os_troca]}">	<br>
		total_os_retirada <input type="text" name="total_os_retirada" id="total_os_retirada" value="{[$resumofinanceiro->total_os_retirada]}">	<br>
		total_recebimento_aberto <input type="text" name="total_recebimento_aberto" id="total_recebimento_aberto" value="{[$resumofinanceiro->total_recebimento_aberto]}">	<br>
		total_recebimento_recebido <input type="text" name="total_recebimento_recebido" id="total_recebimento_recebido" value="{[$resumofinanceiro->total_recebimento_recebido]}">	<br>
		total_recebimento_atrasado <input type="text" name="total_recebimento_atrasado" id="total_recebimento_atrasado" value="{[$resumofinanceiro->total_recebimento_atrasado]}">	<br>
		total_despesa_imposto <input type="text" name="total_despesa_imposto" id="total_despesa_imposto" value="{[$resumofinanceiro->total_despesa_imposto]}">	<br>
		total_despesa_pessoal <input type="text" name="total_despesa_pessoal" id="total_despesa_pessoal" value="{[$resumofinanceiro->total_despesa_pessoal]}">	<br>
		total_despesa_fixa <input type="text" name="total_despesa_fixa" id="total_despesa_fixa" value="{[$resumofinanceiro->total_despesa_fixa]}">	<br>
		total_despesa_variavel <input type="text" name="total_despesa_variavel" id="total_despesa_variavel" value="{[$resumofinanceiro->total_despesa_variavel]}">	<br>
		total_despesa_manutencao <input type="text" name="total_despesa_manutencao" id="total_despesa_manutencao" value="{[$resumofinanceiro->total_despesa_manutencao]}">	<br>
		total_fluxo_caixa <input type="text" name="total_fluxo_caixa" id="total_fluxo_caixa" value="{[$resumofinanceiro->total_fluxo_caixa]}">	<br>
		total_boletos_pagos <input type="text" name="total_boletos_pagos" id="total_boletos_pagos" value="{[$resumofinanceiro->total_boletos_pagos]}">	<br>
		total_pagamentos_cartao <input type="text" name="total_pagamentos_cartao" id="total_pagamentos_cartao" value="{[$resumofinanceiro->total_pagamentos_cartao]}">	<br>
		<br>
		<input type="submit" value='SAVE CHANGES'>
	</form>


</div>