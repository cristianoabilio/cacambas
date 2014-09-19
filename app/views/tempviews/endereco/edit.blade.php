Edit 
{[$endereco->numero]}
<br>
<br>	
<div style='margin-left:200px'>
	
	{[ Form::model($endereco, array('route' => array('endereco.update', $endereco->IDEndereco), 'method' => 'PUT')) ]}


		IDEnderecoBase <input type="text" name="IDEnderecoBase" id="IDEnderecoBase" value="{[$endereco->IDEnderecoBase]}">	<br>
		numero <input type="text" name="numero" id="numero" value="{[$endereco->numero]}">	<br>
		latitude <input type="text" name="latitude" id="latitude" value="{[$endereco->latitude]}">	<br>
		longitude <input type="text" name="longitude" id="longitude" value="{[$endereco->longitude]}">	<br>
		restricao_hr_inicio <input type="text" name="restricao_hr_inicio" id="restricao_hr_inicio" value="{[$endereco->restricao_hr_inicio]}">	<br>
		restricao_hr_fim <input type="text" name="restricao_hr_fim" id="restricao_hr_fim" value="{[$endereco->restricao_hr_fim]}">	<br>
		dthr_cadastro <input type="text" name="dthr_cadastro" id="dthr_cadastro" value="{[$endereco->dthr_cadastro]}">	<br>
		IDSessao <input type="text" name="IDSessao" id="IDSessao" value="{[$endereco->IDSessao]}">	
		<br>
		<br>
		<input type="submit" value='SAVE CHANGES'>
	</form>

	{[ Form::model($endereco, array('route' => array('endereco.destroy', $endereco->IDEndereco), 'method' => 'DELETE')) ]}
	<input type="submit" value='DELETE'>
	</form>
</div>