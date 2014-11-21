<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>
			Index for equipamento resource related to empresa number {[$empresa_id]}
		</h1>
		<a href="{[URL::to('empresa/'.$empresa_id.'/equipamento/create')]}">Add new equipamento resource</a>
		<br>
		<table class='table'>
			<!-- $h var comes from controller, containing
			the header names on table  -->
			<tr>
				<th>
					resource
				</th>
				@foreach($header as $h)
					@if($h[1]==1)
						<th>
							{[$h[0]  ]}
						</th>
					@endif
				@endforeach
			</tr>
			@foreach($equipamentodetail as $e)

				@if($e->status==1)
					<tr>
						<td>
							<a href="{[URL::to('empresa/'.$empresa_id.'/showvisibleequipamento/'.$e->id)]}">HTML resource number {[$e->id]} </a>
							|
							<a href="{[URL::to('empresa/'.$empresa_id.'/equipamento/'.$e->id)]}">JSON resource number {[$e->id]} </a>
							<ul>
								<li>
									<a href="{[URL::to('empresa/'.$empresa_id.'/equipamento/'.$e->id.'/visibleitems')]}">Item as HTML view</a>
									|
									<a href="{[URL::to('empresa/'.$empresa_id.'/equipamento/'.$e->id.'/items')]}">Item as JSON string</a>
								</li>
							</ul>
						</td>
						@foreach($header as $h)
							@if($h[1]==1)
								<td>
									@if($h[0]=='empresa_equipamento_id')
									{[EmpresaEquipamento::find($e->empresa_equipamento_id)->equipamento->classe ]}
									@else 
									{[$e->$h[0]  ]}
									@endif
								</td>
							@endif
						@endforeach
					</tr>
				@endif
			@endforeach
		</table>
		<br>
	</div>
</body>
		