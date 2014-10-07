<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<div style='margin-left:200px'>
	<h1>New resumoatividade for <b>{[$funcionario->nome]}</b></h1>
	Add a new "resumoatividade" for <b>{[$funcionario->nome]}</b>

	<form action="{[URL::to('funcionario/'.$funcionario->id.'/resumoatividade')]}" method="post">
		mes_referencia <input type="text" name="mes_referencia" id="mes_referencia"><br>
		ano_referencia <input type="text" name="ano_referencia" id="ano_referencia"><br>
		total_os_colocada <input type="text" name="total_os_colocada" id="total_os_colocada"><br>
		total_os_troca <input type="text" name="total_os_troca" id="total_os_troca"><br>
		total_os_retirada <input type="text" name="total_os_retirada" id="total_os_retirada"><br>
		<br>
		<input type="submit" value='create'>
	</form>
</div>