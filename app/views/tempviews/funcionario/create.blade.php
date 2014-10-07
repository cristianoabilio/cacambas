<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<div style='margin-left:200px'>
	Add a new "funcionario"

	<form action="{[URL::to('funcionario')]}" method="post">
		login_id <input type="text" name="login_id" id="login_id"><br>
		nome <input type="text" name="nome" id="nome"><br>
		funcao <input type="text" name="funcao" id="funcao"><br>
		telefone <input type="text" name="telefone" id="telefone"><br>
<br>
		<input type="submit" value='create'>
	</form>
	<a href="{[URL::to('funcionario')]}">funcionario</a>
</div>