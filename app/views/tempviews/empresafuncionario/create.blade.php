<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Set "funcionario" on existing users (login) with no funcionario profile for empresa  {[$empresa->nome]}</h1>
		{[Form::open(array('url'=>URL::to('empresa/'.$empresa_id.'/funcionario') ) )]}
		<div class="row">
			<div class="col-sm-2">
				login_id
				<br>
				<select name="login_id" name="login_id" id="login_id" class='form-control'>
					<option value=""></option>
					@foreach(Empresa::find($empresa_id)->login as $l)
						@if($l->funcionario==null)
							<option value="{[$l->id]}">{[$l->login]}</option>
						@endif
					@endforeach
				</select>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				nome
				<br>
				<input type="text" class='form-control' name="nome" id="nome">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				funcao
				<br>
				<input type="text" class='form-control' name="funcao" id="funcao">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				telefone
				<br>
				<input type="text" class='form-control' name="telefone" id="telefone">
			</div>
		</div>
		<br>
		<input type="submit" value='create'>
		{[Form::close()]}
		<br>
		<a href="{[URL::to('empresa/'.$empresa_id.'/visiblefuncionario')]}">Go back to funcionario index</a>
	</div>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</body>
<script type="text/javascript">
	$(function(){
		//
	});
</script>