@extends('tempviews.temporarytemplate')
@section('content')
<h1>Cliente resource  </h1>
<a href="{[URL::to('cliente/create')]}">
	Add new "cliente"
</a>
<table class='table'>
	<!-- $h var comes from controller , containing
	the header names on table  -->
	<tr>
		<th>
			Register
		</th>
	@foreach($header as $h)
		@if($h[1]==1)
			<th>
				{[$h[0]  ]}
			</th>
		@endif
	@endforeach
	</tr>
	@foreach($cliente as $e)
		<tr>
			<td>
				<a href="{[URL::to('empresa/'.$empresa_id.'/showvisiblecliente/'.$e->id)]}">HTML resource {[$e->id]}</a>
				|
				<a href="{[URL::to('empresa/'.$empresa_id.'/cliente/'.$e->id)]}">JSON resource {[$e->id]}</a>
				<ul>
					<li><a href="{[URL::to('empresa/'.$empresa_id.'/cliente/'.$e->id.'/visibleanotacoes')]}">Anotacoe HTML resource {[$e->id]}</a></li>
					<li><a href="{[URL::to('empresa/'.$empresa_id.'/cliente/'.$e->id.'/anotacoes')]}">Anotacoe JSON resource {[$e->id]}</a></li>
				</ul>
			</td>
			@foreach($header as $h)
				@if($h[1]==1)
					<td>{[$e->$h[0]  ]}</td>
				@endif
			@endforeach
		</tr>
	@endforeach
</table>
@stop
@section('scripts')
@stop

