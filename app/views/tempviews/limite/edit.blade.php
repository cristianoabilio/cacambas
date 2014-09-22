Edit 
{[$limite->id]}
<br>
<br>	
<div style='margin-left:200px'>
	
	{[ Form::model($limite, array('route' => array('limite.update', $limite->id), 'method' => 'PUT')) ]}


		motoristas <input type="text" name="motoristas" id="motoristas" value="{[$limite->motoristas]}">	<br>
		caminhoes <input type="text" name="caminhoes" id="caminhoes" value="{[$limite->caminhoes]}">	<br>
		rastreamento <input type="text" name="rastreamento" id="rastreamento" value="{[$limite->rastreamento]}">	<br>
		cacambas <input type="text" name="cacambas" id="cacambas" value="{[$limite->cacambas]}">	<br>
		NFSe <input type="text" name="NFSe" id="NFSe" value="{[$limite->NFSe]}">	<br>
		manutencao <input type="text" name="manutencao" id="manutencao" value="{[$limite->manutencao]}">	<br>
		pagamentos <input type="text" name="pagamentos" id="pagamentos" value="{[$limite->pagamentos]}">	<br>
		fluxo_caixa <input type="text" name="fluxo_caixa" id="fluxo_caixa" value="{[$limite->fluxo_caixa]}">	<br>
		relatorio_avancado <input type="text" name="relatorio_avancado" id="relatorio_avancado" value="{[$limite->relatorio_avancado]}">	<br>
		benchmarks <input type="text" name="benchmarks" id="benchmarks" value="{[$limite->benchmarks]}">	<br>
		
		<br>
		<br>
		<input type="submit" value='SAVE CHANGES'>
	</form>

	{[ Form::model($limite, array('route' => array('limite.destroy', $limite->id), 'method' => 'DELETE')) ]}
	<input type="submit" value='DELETE'>
	</form>
</div>