
<div style='margin-left:200px'>
	Add a new "Endereco"

	<form action="{[URL::to('endereco')]}" method="post">

		IDEnderecoBase <input type="text" name="IDEnderecoBase" id="IDEnderecoBase"><br>
		numero <input type="text" name="numero" id="numero"><br>
		latitude <input type="text" name="latitude" id="latitude"><br>
		longitude <input type="text" name="longitude" id="longitude"><br>
		restricao_hr_inicio <input type="text" name="restricao_hr_inicio" id="restricao_hr_inicio"><br>
		restricao_hr_fim <input type="text" name="restricao_hr_fim" id="restricao_hr_fim"><br>
		IDSessao <input type="text" name="IDSessao" id="IDSessao"><br>

		<br>
		<input type="submit" value='create'>
	</form>
</div>
	