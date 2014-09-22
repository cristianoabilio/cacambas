<div style='margin-left:200px'>
	
	<form action="{[URL::to('plano')]}" method="post">

		limite_id <input type="text" name="limite_id" id="limite_id"><br>
		nome <input type="text" name="nome" id="nome"><br>
		descricao <input type="text" name="descricao" id="descricao"><br>
		valor_total <input type="text" name="valor_total" id="valor_total"><br>
		percentual_desconto <input type="text" name="percentual_desconto" id="percentual_desconto"><br>
		valor_desconto <input type="text" name="valor_desconto" id="valor_desconto"><br>
		status <input type="text" name="status" id="status"><br>
		validade_meses <input type="text" name="validade_meses" id="validade_meses"><br>
		valiade_dias <input type="text" name="valiade_dias" id="valiade_dias"><br>
		disponivel <input type="text" name="disponivel" id="disponivel"><br>
		<br>
		<input type="submit" value='create'>
		<br>
		
	</form>
	<a href="{[URL::to('plano') ]}">Back to plano index</a>


</div>