<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<h1>
	fatura for empresa 
	{[Empresa::find($empresa)->nome]}
</h1>
<p>
	<a href="{[URL::to('convenio/'.$convenio_id.'/fatura/create') ]} ">Add new fatura</a>
</p>

<table class='table'>
	<tr>
		@foreach($header as $h)
			@if($h[1]==1)
				<th>
					{[$h[0]  ]}
				</th>
			@endif
		@endforeach
	</tr>
	@foreach($fatura as $e)
		<tr>
			@foreach($header as $h)
				@if($h[1]==1)
					<td>
						@if($h[0]=='convenio_id')
							<a href="{[URL::to('convenio/'.$convenio_id.'/fatura/'.$e->id) ]} ">{[$e->$h[0]  ]}</a>
						@else
							{[$e->$h[0]  ]}
						@endif
					</td>
				@endif
			@endforeach
		</tr>
	@endforeach
</table>

