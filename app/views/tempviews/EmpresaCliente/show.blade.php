@extends('tempviews.temporarytemplate')
@section('content')
<h1>Cliente resource n {[$id]}</h1>
@foreach($header as $h)
<div class="row">
	<div class="col-sm-2">{[$h[0] ]}</div>
	<div class="col-sm-6">{[$cliente->$h[0]   ]}</div>
</div>
@endforeach
<a href="{[URL::to('empresa/'.$empresa_id.'/cliente/'.$id.'/edit')]} "> ....  Edit .... </a>
<br>
<br>
<a href="{[URL::to('empresa/'.$empresa_id.'/visiblecliente')]}  ">Back to cliente</a>


@stop
@section('scripts')
@stop