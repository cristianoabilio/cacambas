<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
Edit 

<br>
BR	
<div style='margin-left:200px'>
	
	{[ Form::model($cidade, array('route' => array('cidade.update', $cidade->id), 'method' => 'PUT')) ]}

	estado_id <input type="text" name="estado_id" id="estado_id" value="{[$cidade->estado_id]}">	<br>
	nome <input type="text" name="nome" id="nome" value="{[$cidade->nome]}">	<br>
	capital <input type="text" name="capital" id="capital" value="{[$cidade->capital]}">	<br>

<br>
		<input type="submit" value='SAVE CHANGES'>
	</form>

</div>