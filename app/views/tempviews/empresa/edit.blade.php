Edit 
{[$empresa->nome]}
<br>
BR	
<div style='margin-left:200px'>
	
	{[ Form::model($empresa, array('route' => array('empresa.update', $empresa->id), 'method' => 'PUT')) ]}


		nome <input type="text" name="nome" id="nome" value="{[$empresa->nome]}"> <br>
		nome_fantasia <input type="text" name="nome_fantasia" id="nome_fantasia" value="{[$empresa->nome_fantasia]}"> <br>
		cnpj <input type="text" name="cnpj" id="cnpj" value="{[$empresa->cnpj]}"> <br>
		insc_estadual <input type="text" name="insc_estadual" id="insc_estadual" value="{[$empresa->insc_estadual]}"> <br>
		responsavel <input type="text" name="responsavel" id="responsavel" value="{[$empresa->responsavel]}"> <br>
		email <input type="text" name="email" id="email" value="{[$empresa->email]}"> <br>
		telefone <input type="text" name="telefone" id="telefone" value="{[$empresa->telefone]}"> <br>
		celular <input type="text" name="celular" id="celular" value="{[$empresa->celular]}"> <br>
		observacao <input type="text" name="observacao" id="observacao" value="{[$empresa->observacao]}"> <br>
		afiliado <input type="text" name="afiliado" id="afiliado" value="{[$empresa->afiliado]}"> <br>
	
		<br>
		<input type="submit" value='SAVE CHANGES'>
	</form>

	{[ Form::model($empresa, array('route' => array('empresa.destroy', $empresa->id), 'method' => 'DELETE')) ]}
	<input type="submit" value='DELETE'>
	</form>
</div>


