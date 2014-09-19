Edit 
{[$empresa->nome]}
<br>
BR	
<div style='margin-left:200px'>
	
	{[ Form::model($empresa, array('route' => array('empresa.update', $empresa->IDEmpresa), 'method' => 'PUT')) ]}


		nome <input type="text" name="nome" id="nome" value="{[$empresa->nome]}">
		nome_fantasia <input type="text" name="nome_fantasia" id="nome_fantasia" value="{[$empresa->nome_fantasia]}">
		cnpj <input type="text" name="cnpj" id="cnpj" value="{[$empresa->cnpj]}">
		insc_estadual <input type="text" name="insc_estadual" id="insc_estadual" value="{[$empresa->insc_estadual]}">
		responsavel <input type="text" name="responsavel" id="responsavel" value="{[$empresa->responsavel]}">
		email <input type="text" name="email" id="email" value="{[$empresa->email]}">
		telefone <input type="text" name="telefone" id="telefone" value="{[$empresa->telefone]}">
		celular <input type="text" name="celular" id="celular" value="{[$empresa->celular]}">
		observacao <input type="text" name="observacao" id="observacao" value="{[$empresa->observacao]}">
		afiliado <input type="text" name="afiliado" id="afiliado" value="{[$empresa->afiliado]}">
		IDSessao <input type="text" name="IDSessao" id="IDSessao" value="{[$empresa->IDSessao]}">


		<br>
		<input type="submit" value='SAVE CHANGES'>
	</form>

	{[ Form::model($empresa, array('route' => array('empresa.destroy', $empresa->IDEmpresa), 'method' => 'DELETE')) ]}
	<input type="submit" value='DELETE'>
	</form>
</div>


