		

<div style='margin-left:200px'>
	Add a new "convenio"

	<form action="{[URL::to('convenio')]}" method="post">

		IDEmpresa <input type="text" name="IDEmpresa" id="IDEmpresa"><br>
		IDPlano <input type="text" name="IDPlano" id="IDPlano"><br>
		IDLimite <input type="text" name="IDLimite" id="IDLimite"><br>
		total_nfse <input type="text" name="total_nfse" id="total_nfse"><br>
		dia_fatura <input type="text" name="dia_fatura" id="dia_fatura"><br>
		tipo_pagamento <input type="text" name="tipo_pagamento" id="tipo_pagamento"><br>
		dt_inicio <input type="text" name="dt_inicio" id="dt_inicio"><br>
		dt_fim <input type="text" name="dt_fim" id="dt_fim"><br>
		dthr_cadastro <input type="text" name="dthr_cadastro" id="dthr_cadastro"><br>
		IDSessao <input type="text" name="IDSessao" id="IDSessao"><br>

		<br>
		<input type="submit" value='create'>
		<br>
		<a href="{[URL::to('convenio') ]}">Back to convenio index</a>
	</form>
</div>