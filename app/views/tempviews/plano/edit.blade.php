<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Edit <b class="text-info"> "{[$plano->nome]}"</b> plan</h1>
		{[ Form::model($plano, array('route' => array('plano.update', $plano->id), 'method' => 'PUT')) ]}
			<div class="row">
				<div class="col-sm-2">
					nome
				</div>
				<div class="col-sm-6">
					<input type="text" name="nome" id="nome" value="{[$plano->nome]}">
				</div>
			</div>
			<br><div class="row">
				<div class="col-sm-2">
					descricao
				</div>
				<div class="col-sm-6">
					<input type="text" name="descricao" id="descricao" value="{[$plano->descricao]}">
				</div>
			</div>
			<br><div class="row">
				<div class="col-sm-2">
					valor_total
				</div>
				<div class="col-sm-6">
					<input type="text" name="valor_total" id="valor_total" value="{[$plano->valor_total]}">
				</div>
			</div>
			<br><div class="row">
				<div class="col-sm-2"></div>
				<div class="col-sm-6"></div>
			</div>
			<br>
	</div>
</body>
Edit 

<br>
<br>	
<div style='margin-left:200px'>
		 	<br>
		 	<br>
		percentual_desconto <input type="text" name="percentual_desconto" id="percentual_desconto" value="{[$plano->percentual_desconto]}">	<br>
		valor_desconto <input type="text" name="valor_desconto" id="valor_desconto" value="{[$plano->valor_desconto]}">	<br>
		status <input type="text" name="status" id="status" value="{[$plano->status]}">	<br>
		validade_meses <input type="text" name="validade_meses" id="validade_meses" value="{[$plano->validade_meses]}">	<br>
		valiade_dias <input type="text" name="valiade_dias" id="valiade_dias" value="{[$plano->valiade_dias]}">	<br>
		disponivel <input type="text" name="disponivel" id="disponivel" value="{[$plano->disponivel]}">	<br>
		IDSessao <input type="text" name="IDSessao" id="IDSessao" value="{[$plano->IDSessao]}">	<br>
		dthr_cadastro <input type="text" name="dthr_cadastro" id="dthr_cadastro" value="{[$plano->dthr_cadastro]}">	<br>


		<br>
		<br>
		<input type="submit" value='SAVE CHANGES'>
	</form>

	{[ Form::model($plano, array('route' => array('plano.destroy', $plano->id), 'method' => 'DELETE')) ]}
	<input type="submit" value='DELETE'>
	</form>
</div>