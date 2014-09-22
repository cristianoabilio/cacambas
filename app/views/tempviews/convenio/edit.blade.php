		

Edit 
{[$convenio->IDEmpresa]}
<br>
<br>	
<div style='margin-left:200px'>
	
	{[ Form::model($convenio, array('route' => array('convenio.update', $convenio->id), 'method' => 'PUT')) ]}


		plano_id <input type="text" name="plano_id" id="plano_id" value="{[$convenio->plano_id]}">	<br>
		limite_id <input type="text" name="limite_id" id="limite_id" value="{[$convenio->limite_id]}">	<br>
		total_nfse <input type="text" name="total_nfse" id="total_nfse" value="{[$convenio->total_nfse]}">	<br>
		dia_fatura <input type="text" name="dia_fatura" id="dia_fatura" value="{[$convenio->dia_fatura]}">	<br>
		tipo_pagamento <input type="text" name="tipo_pagamento" id="tipo_pagamento" value="{[$convenio->tipo_pagamento]}">	<br>
		dt_inicio <input type="text" name="dt_inicio" id="dt_inicio" value="{[$convenio->dt_inicio]}">	<br>
		dt_fim <input type="text" name="dt_fim" id="dt_fim" value="{[$convenio->dt_fim]}">	<br>
		<br>
		<br>
		<input type="submit" value='SAVE CHANGES'>
	</form>

	
</div>