		

Edit 
{[$convenio->IDEmpresa]}
<br>
<br>	
<div style='margin-left:200px'>
	
	{[ Form::model($convenio, array('route' => array('convenio.update', $convenio->IDConvenio), 'method' => 'PUT')) ]}


		IDEmpresa <input type="text" name="IDEmpresa" id="IDEmpresa" value="{[$convenio->IDEmpresa]}">	<br>
		IDPlano <input type="text" name="IDPlano" id="IDPlano" value="{[$convenio->IDPlano]}">	<br>
		IDLimite <input type="text" name="IDLimite" id="IDLimite" value="{[$convenio->IDLimite]}">	<br>
		total_nfse <input type="text" name="total_nfse" id="total_nfse" value="{[$convenio->total_nfse]}">	<br>
		dia_fatura <input type="text" name="dia_fatura" id="dia_fatura" value="{[$convenio->dia_fatura]}">	<br>
		tipo_pagamento <input type="text" name="tipo_pagamento" id="tipo_pagamento" value="{[$convenio->tipo_pagamento]}">	<br>
		dt_inicio <input type="text" name="dt_inicio" id="dt_inicio" value="{[$convenio->dt_inicio]}">	<br>
		dt_fim <input type="text" name="dt_fim" id="dt_fim" value="{[$convenio->dt_fim]}">	<br>
		dthr_cadastro <input type="text" name="dthr_cadastro" id="dthr_cadastro" value="{[$convenio->dthr_cadastro]}">	<br>
		IDSessao <input type="text" name="IDSessao" id="IDSessao" value="{[$convenio->IDSessao]}">	<br>

		<br>
		<br>
		<input type="submit" value='SAVE CHANGES'>
	</form>

	
</div>