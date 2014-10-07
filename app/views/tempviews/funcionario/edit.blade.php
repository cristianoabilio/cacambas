<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<?php  
$fake=new fakeuser;
?>
Edit 
{[$funcionario->funcionario_id]}

for empresa 
{[Empresa::find($fake->empresa())->nome]}
<br>
BR	
<div style='margin-left:200px'>
	
	{[ Form::model($funcionario, array('route' => array('funcionario.update', $funcionario->id), 'method' => 'PUT')) ]}
		login_id <input type="text" name="login_id" id="login_id" value="{[$funcionario->login_id]}">	<br>
		nome <input type="text" name="nome" id="nome" value="{[$funcionario->nome]}">	<br>
		funcao <input type="text" name="funcao" id="funcao" value="{[$funcionario->funcao]}">	<br>
		telefone <input type="text" name="telefone" id="telefone" value="{[$funcionario->telefone]}">	<br>
		
		<br>
		<input type="submit" value='SAVE CHANGES'>
	</form>

	{[ Form::model($funcionario, array('route' => array('funcionario.destroy', $funcionario->id), 'method' => 'DELETE')) ]}
	<input type='submit' value='delete'>
	</form>
</div>