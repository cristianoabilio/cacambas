@extends('tempviews.temporarytemplate')
@section('content')
<h1>Edit cliente resource number {[$id]}</h1>
{[ Form::model($cliente, array('route' => array('empresa.cliente.update', $empresa_id,$id), 'method' => 'PUT')) ]}
<div class="row">
	<div class="col-sm-4">
		login_id <input type="text" class="form-control" name="login_id" id="login_id" value="{[$cliente->login_id]}">
		cpf_cnpj <input type="text" class="form-control" name="cpf_cnpj" id="cpf_cnpj" value="{[$cliente->cpf_cnpj]}">
		pj <input type="text" class="form-control" name="pj" id="pj" value="{[$cliente->pj]}">
		nome <input type="text" class="form-control" name="nome" id="nome" value="{[$cliente->nome]}">
		tipo_cliente <input type="text" class="form-control" name="tipo_cliente" id="tipo_cliente" value="{[$cliente->tipo_cliente]}">
		tipo_pagamento <input type="text" class="form-control" name="tipo_pagamento" id="tipo_pagamento" value="{[$cliente->tipo_pagamento]}">
		forma_pagamento <input type="text" class="form-control" name="forma_pagamento" id="forma_pagamento" value="{[$cliente->forma_pagamento]}">
		total_pago <input type="text" class="form-control" name="total_pago" id="total_pago" value="{[$cliente->total_pago]}">
		badge <input type="text" class="form-control" name="badge" id="badge" value="{[$cliente->badge]}">
	</div>
	<div class="col-sm-4"></div>
	<div class="col-sm-4"></div>
</div>
		



<input type="submit" value='SAVE CHANGES'>
<a href="{[URL::to('empresa/'.$empresa_id.'/visiblecliente')]}  ">Back to cliente index</a>
{[Form::close()]}

@stop
@section('scripts')
@stop