<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
Edit 
{[$plano->nome]}
<br>
<br>	
<div style='margin-left:200px'>
	
	{[ Form::model($plano, array('route' => array('plano.update', $plano->id), 'method' => 'PUT')) ]}


		nome <input type="text" name="nome" id="nome" value="{[$plano->nome]}">	<br>
		descricao <input type="text" name="descricao" id="descricao" value="{[$plano->descricao]}">	<br>
		valor_total <input type="text" name="valor_total" id="valor_total" value="{[$plano->valor_total]}">	<br>
		percentual_desconto <input type="text" name="percentual_desconto" id="percentual_desconto" value="{[$plano->percentual_desconto]}">	<br>
		valor_desconto <input type="text" name="valor_desconto" id="valor_desconto" value="{[$plano->valor_desconto]}">	<br>
		status <input type="text" name="status" id="status" value="{[$plano->status]}">	<br>
		validade_meses <input type="text" name="validade_meses" id="validade_meses" value="{[$plano->validade_meses]}">	<br>
		valiade_dias <input type="text" name="valiade_dias" id="valiade_dias" value="{[$plano->valiade_dias]}">	<br>
		disponivel <input type="text" name="disponivel" id="disponivel" value="{[$plano->disponivel]}">	<br>
		IDSessao <input type="text" name="IDSessao" id="IDSessao" value="{[$plano->IDSessao]}">	<br>
		dthr_cadastro <input type="text" name="dthr_cadastro" id="dthr_cadastro" value="{[$plano->dthr_cadastro]}">	<br>


		<br>
		<br>
		<input type="submit" value='SAVE CHANGES'>
	</form>

	{[ Form::model($plano, array('route' => array('plano.destroy', $plano->id), 'method' => 'DELETE')) ]}
	<input type="submit" value='DELETE'>
	</form>
</div>