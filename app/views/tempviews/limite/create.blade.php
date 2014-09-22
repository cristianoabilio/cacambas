
<div style='margin-left:200px'>
	Add a new "limite"

	<form action="{[URL::to('limite')]}" method="post">

		motoristas <input type="text" name="motoristas" id="motoristas"><br>
		caminhoes <input type="text" name="caminhoes" id="caminhoes"><br>
		rastreamento <input type="text" name="rastreamento" id="rastreamento"><br>
		cacambas <input type="text" name="cacambas" id="cacambas"><br>
		NFSe <input type="text" name="NFSe" id="NFSe"><br>
		manutencao <input type="text" name="manutencao" id="manutencao"><br>
		pagamentos <input type="text" name="pagamentos" id="pagamentos"><br>
		fluxo_caixa <input type="text" name="fluxo_caixa" id="fluxo_caixa"><br>
		relatorio_avancado <input type="text" name="relatorio_avancado" id="relatorio_avancado"><br>
		benchmarks <input type="text" name="benchmarks" id="benchmarks"><br>
		
		<br>
		<input type="submit" value='create'>
		<br>
		<a href="{[URL::to('limite') ]}">Back to limite index</a>
	</form>
</div>