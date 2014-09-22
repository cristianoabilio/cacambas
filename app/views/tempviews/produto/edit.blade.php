Edit 
{[$produto->nome]}
<br>
<br>	
<div style='margin-left:200px'>
	
	{[ Form::model($produto, array('route' => array('produto.update', $produto->id), 'method' => 'PUT')) ]}


		nome <input type="text" name="nome" id="nome" value="{[$produto->nome]}">	<br>
		descricao <input type="text" name="descricao" id="descricao" value="{[$produto->descricao]}">	<br>
		requisitos <input type="text" name="requisitos" id="requisitos" value="{[$produto->requisitos]}">	<br>
		url_imagem <input type="text" name="url_imagem" id="url_imagem" value="{[$produto->url_imagem]}">	<br>
		url_video <input type="text" name="url_video" id="url_video" value="{[$produto->url_video]}">	<br>
		valor <input type="text" name="valor" id="valor" value="{[$produto->valor]}">	<br>
		custo_extra <input type="text" name="custo_extra" id="custo_extra" value="{[$produto->custo_extra]}">	<br>
		servico <input type="text" name="servico" id="servico" value="{[$produto->servico]}">	<br>
		limite <input type="text" name="limite" id="limite" value="{[$produto->limite]}">	<br>
		observacao <input type="text" name="observacao" id="observacao" value="{[$produto->observacao]}">	<br>
		perfil_id <input type="text" name="perfil_id" id="perfil_id" value="{[$produto->perfil_id]}">	<br>
		


		<br>
		<br>
		<input type="submit" value='SAVE CHANGES'>
	</form>

	{[ Form::model($produto, array('route' => array('produto.destroy', $produto->id), 'method' => 'DELETE')) ]}
	<input type="submit" value='DELETE'>
	</form>
</div>