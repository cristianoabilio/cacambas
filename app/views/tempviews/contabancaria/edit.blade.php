Edit 
{[$conta->nome_banco]}
<br>
BR	
<div style='margin-left:200px'>
	
	{[ Form::model($conta, array('route' => array('contabancaria.update', $conta->IDConta), 'method' => 'PUT')) ]}


		IDEmpresa <input type="text" name="IDEmpresa" id="IDEmpresa" value="{[$conta->IDEmpresa]}">	<br>
		nome_banco <input type="text" name="nome_banco" id="nome_banco" value="{[$conta->nome_banco]}">	<br>
		codigo_banco <input type="text" name="codigo_banco" id="codigo_banco" value="{[$conta->codigo_banco]}">	<br>
		conta <input type="text" name="conta" id="conta" value="{[$conta->conta]}">	<br>
		conta_dig <input type="text" name="conta_dig" id="conta_dig" value="{[$conta->conta_dig]}">	<br>
		conta_tipo <input type="text" name="conta_tipo" id="conta_tipo" value="{[$conta->conta_tipo]}">	<br>
		agencia <input type="text" name="agencia" id="agencia" value="{[$conta->agencia]}">	<br>
		agencia_dig <input type="text" name="agencia_dig" id="agencia_dig" value="{[$conta->agencia_dig]}">	<br>
		cpf_cnpj <input type="text" name="cpf_cnpj" id="cpf_cnpj" value="{[$conta->cpf_cnpj]}">	<br>
		pj <input type="text" name="pj" id="pj" value="{[$conta->pj]}">	<br>
		titular <input type="text" name="titular" id="titular" value="{[$conta->titular]}">	<br>
		dthr_cadastro <input type="text" name="dthr_cadastro" id="dthr_cadastro" value="{[$conta->dthr_cadastro]}">	<br>
		IDSessao <input type="text" name="IDSessao" id="IDSessao" value="{[$conta->IDSessao]}">	<br>



		<br>
		<input type="submit" value='SAVE CHANGES'>
	</form>

	{[ Form::model($conta, array('route' => array('contabancaria.destroy', $conta->IDConta), 'method' => 'DELETE')) ]}
	<input type="submit" value='DELETE'>
	</form>
</div>


