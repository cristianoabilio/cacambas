<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>

Edit 
<?php 
$fake=new fakeuser; ?>
{[Empresa::find($fake->empresa())->nome]}
<br>
BR	
<div style='margin-left:200px'>
	
	{[ Form::model($resumoempresacliente, array('route' => array('resumoempresacliente.update', $resumoempresacliente->id), 'method' => 'PUT')) ]}

		cliente_id <input type="text" name="cliente_id" id="cliente_id" value="{[$resumoempresacliente->cliente_id]}">	<br>
		mes_referencia <input type="text" name="mes_referencia" id="mes_referencia" value="{[$resumoempresacliente->mes_referencia]}">	<br>
		ano_referencia <input type="text" name="ano_referencia" id="ano_referencia" value="{[$resumoempresacliente->ano_referencia]}">	<br>
		total_locacoes <input type="text" name="total_locacoes" id="total_locacoes" value="{[$resumoempresacliente->total_locacoes]}">	<br>
		total_aberto <input type="text" name="total_aberto" id="total_aberto" value="{[$resumoempresacliente->total_aberto]}">	<br>
		total_recebido <input type="text" name="total_recebido" id="total_recebido" value="{[$resumoempresacliente->total_recebido]}">	<br>
		total_atrasado <input type="text" name="total_atrasado" id="total_atrasado" value="{[$resumoempresacliente->total_atrasado]}">	<br>

		<br>
		<input type="submit" value='SAVE CHANGES'>
	</form>


</div>