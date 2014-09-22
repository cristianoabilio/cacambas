<?php  
$fake=new fakeuser;
?>
Edit 
{[$resumoatividade->funcionario_id]}

for empresa 
{[Empresa::find($fake->empresa())->nome]}
<br>
BR	
<div style='margin-left:200px'>
	
	{[ Form::model($resumoatividade, array('route' => array('resumoatividade.update', $resumoatividade->id), 'method' => 'PUT')) ]}

		funcionario_id <input type="text" name="funcionario_id" id="funcionario_id" value="{[$resumoatividade->funcionario_id]}">	<br>
		mes_referencia <input type="text" name="mes_referencia" id="mes_referencia" value="{[$resumoatividade->mes_referencia]}">	<br>
		ano_referencia <input type="text" name="ano_referencia" id="ano_referencia" value="{[$resumoatividade->ano_referencia]}">	<br>
		total_os_colocada <input type="text" name="total_os_colocada" id="total_os_colocada" value="{[$resumoatividade->total_os_colocada]}">	<br>
		total_os_troca <input type="text" name="total_os_troca" id="total_os_troca" value="{[$resumoatividade->total_os_troca]}">	<br>
		total_os_retirada <input type="text" name="total_os_retirada" id="total_os_retirada" value="{[$resumoatividade->total_os_retirada]}">	<br>
		<br>
		<input type="submit" value='SAVE CHANGES'>
	</form>

</div>