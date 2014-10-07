<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
Edit 
{[$compras->produto_id]}
<br>
BR	
<div style='margin-left:200px'>
	
	{[ Form::model($compras, array('route' => array('compras.update', $compras->id), 'method' => 'PUT')) ]}


		
		produto_id <input type="text" name="produto_id" id="produto_id" value="{[$compras->produto_id]}">	<br>
		convenio_id <input type="text" name="convenio_id" id="convenio_id" value="{[$compras->convenio_id]}">	<br>
		limite <input type="text" name="limite" id="limite" value="{[$compras->limite]}">	<br>
		desconto_valor <input type="text" name="desconto_valor" id="desconto_valor" value="{[$compras->desconto_valor]}">	<br>
		desconto_percentual <input type="text" name="desconto_percentual" id="desconto_percentual" value="{[$compras->desconto_percentual]}">	<br>
		ativado <input type="text" name="ativado" id="ativado" value="{[$compras->ativado]}">	<br>
		data_compra <input type="text" name="data_compra" id="data_compra" value="{[$compras->data_compra]}">	<br>
		data_ativacao <input type="text" name="data_ativacao" id="data_ativacao" value="{[$compras->data_ativacao]}">	<br>
		data_desativacao <input type="text" name="data_desativacao" id="data_desativacao" value="{[$compras->data_desativacao]}">	<br>

		<br>
		<input type="submit" value='SAVE CHANGES'>
	</form>

	{[ Form::model($compras, array('route' => array('compras.destroy', $compras->id), 'method' => 'DELETE')) ]}
	<input type="submit" value='DELETE'>
	</form>
</div>
