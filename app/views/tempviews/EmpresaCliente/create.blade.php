@extends('tempviews.temporarytemplate')
@section('content')
<h1>Create a new cliente</h1>
<div class="row ">
	<div class="col-sm-4">
		{[Form::open(array('url'=>URL::to('empresa/'.$empresa_id.'/cliente') ))]}
		login_id <input type="text" class="form-control" name="login_id" id="login_id"><br>
		cpf_cnpj <input type="text" class="form-control" name="cpf_cnpj" id="cpf_cnpj"><br>
		pj <input type="text" class="form-control" name="pj" id="pj"><br>
		nome <input type="text" class="form-control" name="nome" id="nome"><br>
		tipo_cliente <input type="text" class="form-control" name="tipo_cliente" id="tipo_cliente"><br>
		tipo_pagamento <input type="text" class="form-control" name="tipo_pagamento" id="tipo_pagamento"><br>
		forma_pagamento <input type="text" class="form-control" name="forma_pagamento" id="forma_pagamento"><br>
		total_pago <input type="text" class="form-control" name="total_pago" id="total_pago"><br>
		badge <input type="text" class="form-control" name="badge" id="badge"><br>
		<input type="submit">
		{[Form::close()]}
		<a href="{[URL::to('empresa/'.$empresa_id.'/visiblecliente')]}">Go back to cliente index</a>
	</div>
	<div class="col-sm-4"></div>
	<div class="col-sm-4"></div>
</div>
		



@stop
@section('scripts')
@stop