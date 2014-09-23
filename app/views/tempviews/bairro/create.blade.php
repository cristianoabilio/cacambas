<div style='margin-left:200px'>
	Add a new "bairro"

	<form action="{[URL::to('bairro')]}" method="post">
		cidade_id <input type="text" name="cidade_id" id="cidade_id"><br>
		estado_id <input type="text" name="estado_id" id="estado_id"><br>
		zona <input type="text" name="zona" id="zona"><br>
		nome <input type="text" name="nome" id="nome"><br>

		<br>
		<input type="submit" value='create'>
	</form>
</div>