<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<div style='margin-left:200px'>
	Add a new "resumoempresacliente"

	<form action="{[URL::to('resumoempresacliente')]}" method="post">
	cliente_id <input type="text" name="cliente_id" id="cliente_id"><br>
	mes_referencia <input type="text" name="mes_referencia" id="mes_referencia"><br>
	ano_referencia <input type="text" name="ano_referencia" id="ano_referencia"><br>
	total_locacoes <input type="text" name="total_locacoes" id="total_locacoes"><br>
	total_aberto <input type="text" name="total_aberto" id="total_aberto"><br>
	total_recebido <input type="text" name="total_recebido" id="total_recebido"><br>
	total_atrasado <input type="text" name="total_atrasado" id="total_atrasado"><br>

		<br>
		<input type="submit" value='create'>
	</form>
</div>