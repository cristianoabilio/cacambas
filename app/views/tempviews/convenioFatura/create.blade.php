<h1>
	Add new fatura for {[Empresa::find($empresa_id)->nome]}
</h1>

<form 
action="{[URL::to('convenio/'.$c_id.'/fatura')]}" method="post">
Convenio_id {[$c_id]} (should be hidden)
<input type='hidden' name='convenio_id' id='convenio_id' value='{[$c_id]}' /> 
<br>
Empresa: not required (should be removed from schema)
<br>
<br>
Note: on javascript code or jquery function must be added
in order to allow user to choose only one option 
between "mes_referencia", "semestre_referencia"
and "ano_referencia"
<br>
Mes referencia
<select id='mes_referencia'  name='mes_referencia'  >
	<option></option>
	<?php 
	for ($i=0; $i <12 ; $i++) { 
		echo 
		'<option value="'.($i+1).'">mes '.($i+1).'</option>'
		;
	}
	 ?>
</select>
|| Semestre referencia 
<select id='semestre_referencia'  name='semestre_referencia'  >
	<option></option>
	<option value='1'>semestre 1</option>
	<option value='2'>semestre 2</option>
</select>
|| Ano
<br>
data_vencimento: autocalculated
{[$convenio->dia_fatura=1]}
<br>
<br>
date of plan start {[$convenio->dt_inicio]}
<br>


@if($count_fatura==0)
<h2>First time fatura</h2>
	@if(substr($convenio->dt_inicio, 8)*1 < $convenio->dia_fatura)
		fatura invoice due date on same month of start date.
		<br>
		convenio starts at {[substr($convenio->dt_inicio, 8)]}
		<br>
		Data vencimiento=
		{[ substr($convenio->dt_inicio,0,8) ]}{[$convenio->dia_fatura]}
	@else
		fatura invoice one month after start date
		<br>
		convenio starts at 
		{[$convenio->dt_inicio]}
		
		<br>
		Data vencimiento=
		{[ substr($convenio->dt_inicio,0,4) ]}-
		{[substr($convenio->dt_inicio, 6,2)*1 + 1]}-
		{[$convenio->dia_fatura]}
	@endif
@else
<h2>Fatura vencimento</h2>

@endif
<br>
last fatura: pending to add last fatura


calculated on backend
<hr>
<br>
Valor total plano {[$convenio->plano->valor_total]}
<br>
% discount {[$convenio->plano->percentual_desconto]}




<br>
<input type='submit' value='create'/>
</form>