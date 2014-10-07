<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>

<div style='margin-left:200px'>
	Add a new "Endereco"

	<form action="{[URL::to('endereco')]}" method="post">

1. Enderecobase
		bairro_id 	<input type="text" name="bairro_id" id="bairro_id">	<br>
		cidade_id 	<input type="text" name="cidade_id" id="cidade_id">	<br>
		estado_id 	<input type="text" name="estado_id" id="estado_id">	<br>
		cep 		<input type="text" name="cep" id="cep">				<br>
		logradouro 	<input type="text" name="logradouro" id="logradouro"><br>
		regiao 		<input type="text" name="regiao" id="regiao">		<br>
		restricao_hr_inicio <input type="text" name="restricao_hr_inicio" id="restricao_hr_inicio"><br>
		restricao_hr_fim <input type="text" name="restricao_hr_fim" id="restricao_hr_fim"><br>
		numero_inicio <input type="text" name="numero_inicio" id="numero_inicio"><br>
		numero_fim <input type="text" name="numero_fim" id="numero_fim"><br>

2. Endereco
<br>
		enderecobase_id <br>
		numero 			<input type="text" name="numero" id="numero"><br>
		cep 			<br>
		latitude 		<input type="text" name="latitude" id="latitude"><br>
		longitude 		<input type="text" name="longitude" id="longitude"><br>
		restricao_hr_inicio <br>
		restricao_hr_fim <br>
3. Enderecoempresa
<br>
		empresa_id 		<br>
		enderecobase_id  <br>
		endereco_id 	<br>
		tipo 			<input type="text" name="tipo" id="tipo"><br>
		complemento 	<input type="text" name="complemento" id="complemento"><br>
		observacao 		<input type="text" name="observacao" id="observacao"><br>
		status 			<input type="text" name="status" id="status"><br>
		

		<br>
		<input type="submit" value='create'>
	</form>
</div>
	