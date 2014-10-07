<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<div style='margin-left:200px'>
	Add a new "contabancaria" for empresa 

	<form action="{[URL::to('contabancaria')]}" method="post">

		nome_banco <input type="text" name="nome_banco" id="nome_banco"><br>
		codigo_banco <input type="text" name="codigo_banco" id="codigo_banco"><br>
		conta <input type="text" name="conta" id="conta"><br>
		conta_dig <input type="text" name="conta_dig" id="conta_dig"><br>
		conta_tipo <input type="text" name="conta_tipo" id="conta_tipo"><br>
		agencia <input type="text" name="agencia" id="agencia"><br>
		agencia_dig <input type="text" name="agencia_dig" id="agencia_dig"><br>
		cpf_cnpj <input type="text" name="cpf_cnpj" id="cpf_cnpj"><br>
		pj <input type="text" name="pj" id="pj"><br>
		titular <input type="text" name="titular" id="titular"><br>

		<br>
		<input type="submit" value='create'>
	</form>
</div>




