Edit 
{[$bairro->produto_id]}
<br>
BR	
<div style='margin-left:200px'>
	
	{[ Form::model($bairro, array('route' => array('bairro.update', $bairro->id), 'method' => 'PUT')) ]}


		
		cidade_id <input type="text" name="cidade_id" id="cidade_id" value="{[$bairro->cidade_id]}">	<br>
		estado_id <input type="text" name="estado_id" id="estado_id" value="{[$bairro->estado_id]}">	<br>
		zona <input type="text" name="zona" id="zona" value="{[$bairro->zona]}">	<br>
		nome <input type="text" name="nome" id="nome" value="{[$bairro->nome]}">	<br>
		<br>
		<input type="submit" value='SAVE CHANGES'>
	</form>

</div>