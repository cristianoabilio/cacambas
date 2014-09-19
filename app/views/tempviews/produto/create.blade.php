<div style='margin-left:200px'>
	
	<form action="{[URL::to('produto')]}" method="post">

		nome <input type="text" name="nome" id="nome"><br>
		descricao <input type="text" name="descricao" id="descricao"><br>
		requisitos <input type="text" name="requisitos" id="requisitos"><br>
		url_imagem <input type="text" name="url_imagem" id="url_imagem"><br>
		url_video <input type="text" name="url_video" id="url_video"><br>
		valor <input type="text" name="valor" id="valor"><br>
		custo_extra <input type="text" name="custo_extra" id="custo_extra"><br>
		servico <input type="text" name="servico" id="servico"><br>
		limite <input type="text" name="limite" id="limite"><br>
		status <input type="text" name="status" id="status"><br>
		observacao <input type="text" name="observacao" id="observacao"><br>
		IDPerfil <input type="text" name="IDPerfil" id="IDPerfil"><br>
		IDSessao <input type="text" name="IDSessao" id="IDSessao"><br>
		dthr_cadastro <input type="text" name="dthr_cadastro" id="dthr_cadastro"><br>

		<br>
		<input type="submit" value='create'>
		<br>
		
	</form>
	<a href="{[URL::to('produto') ]}">Back to produto index</a>


</div>