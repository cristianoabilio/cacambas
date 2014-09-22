		

<div style='margin-left:200px'>
	Add a new "convenio"
	for empresa 
	<?php $fake= new fakeuser;
	?>
	{[ Empresa::find($fake->empresa())->nome ]}
	<form action="{[URL::to('convenio')]}" method="post">


		plano_id <input type="text" name="plano_id" id="plano_id"><br>
		limite_id <input type="text" name="limite_id" id="limite_id"><br>
		total_nfse <input type="text" name="total_nfse" id="total_nfse"><br>
		dia_fatura <input type="text" name="dia_fatura" id="dia_fatura"><br>
		tipo_pagamento <input type="text" name="tipo_pagamento" id="tipo_pagamento"><br>
		dt_inicio <input type="text" name="dt_inicio" id="dt_inicio"><br>
		dt_fim <input type="text" name="dt_fim" id="dt_fim"><br>
		dthr_cadastro <input type="text" name="dthr_cadastro" id="dthr_cadastro"><br>
		<br>
		<input type="submit" value='create'>
		<br>
		<a href="{[URL::to('convenio') ]}">Back to convenio index</a>
	</form>
</div>