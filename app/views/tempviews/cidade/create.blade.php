<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<div style='margin-left:200px'>
	Add a new "cidade"

	<form action="{[URL::to('cidade')]}" method="post">
		estado_id <input type="text" name="estado_id" id="estado_id"><br>
		nome <input type="text" name="nome" id="nome"><br>
		capital <input type="text" name="capital" id="capital"><br>



		<br>
		<input type="submit" value='create'>
	</form>
</div>