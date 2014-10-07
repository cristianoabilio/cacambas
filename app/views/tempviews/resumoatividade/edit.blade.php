<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<h1>Funcionario {[$resumoatividade->Funcionario->nome]}</h1>
<p>
	empresa <b> {[$resumoatividade->Funcionario->Empresa->nome]}</b>
</p>


<?php  
$fake=new fakeuser;
?>
Edit register number
{[$resumoatividade->id]}


<div style='margin-left:200px'>
	
	{[ Form::model($resumoatividade, array('route' => array('funcionario.resumoatividade.update',$resumoatividade->Funcionario->id,$resumoatividade->id), 'method' => 'PUT')) ]}

		mes_referencia <input type="text" name="mes_referencia" id="mes_referencia" value="{[$resumoatividade->mes_referencia]}">	<br>
		ano_referencia <input type="text" name="ano_referencia" id="ano_referencia" value="{[$resumoatividade->ano_referencia]}">	<br>
		total_os_colocada <input type="text" name="total_os_colocada" id="total_os_colocada" value="{[$resumoatividade->total_os_colocada]}">	<br>
		total_os_troca <input type="text" name="total_os_troca" id="total_os_troca" value="{[$resumoatividade->total_os_troca]}">	<br>
		total_os_retirada <input type="text" name="total_os_retirada" id="total_os_retirada" value="{[$resumoatividade->total_os_retirada]}">	<br>
		<br>
		<input type="submit" value='SAVE CHANGES'>
	</form>

</div>