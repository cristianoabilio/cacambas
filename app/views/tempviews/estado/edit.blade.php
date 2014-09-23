Edit 

<br>
BR	
<div style='margin-left:200px'>
	
	{[ Form::model($estado, array('route' => array('estado.update', $estado->id), 'method' => 'PUT')) ]}

	nome <input type="text" name="nome" id="nome" value="{[$estado->nome]}">	<br>
	regiao <input type="text" name="regiao" id="regiao" value="{[$estado->regiao]}">	<br>

<br>
		<input type="submit" value='SAVE CHANGES'>
	</form>

</div>