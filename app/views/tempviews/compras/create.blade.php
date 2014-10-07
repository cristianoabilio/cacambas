<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<div style='margin-left:200px'>
	Add a new "compra"

	<form action="{[URL::to('compras')]}" method="post">
		produto_id <input type="text" name="produto_id" id="produto_id"><br>
		convenio_id <input type="text" name="convenio_id" id="convenio_id"><br>
		limite <input type="text" name="limite" id="limite"><br>
		desconto_valor <input type="text" name="desconto_valor" id="desconto_valor"><br>
		desconto_percentual <input type="text" name="desconto_percentual" id="desconto_percentual"><br>
		ativado <input type="text" name="ativado" id="ativado"><br>
		data_compra <input type="text" name="data_compra" id="data_compra"><br>
		data_ativacao <input type="text" name="data_ativacao" id="data_ativacao"><br>
		data_desativacao <input type="text" name="data_desativacao" id="data_desativacao"><br>

		<br>
		<input type="submit" value='create'>
	</form>
</div>