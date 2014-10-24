<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>
			fatura for empresa 
			{[Empresa::find($empresa_id)->nome]}
		</h1>
		<p>
			<a href="{[URL::to('empresa/'.$empresa_id.'/convenio/'.$convenio_id.'/fatura/create') ]} ">Add new fatura</a>
		</p>
		<table class='table'>
			<tr>
				<td>Resource</td>
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
					<td>
						<a href="{[URL::to('empresa/'.$empresa_id.'/convenio/'.$convenio_id.'/showvisiblefatura/'.$e->id) ]}">HTML resource </a>
						|
						<a href="{[URL::to('empresa/'.$empresa_id.'/convenio/'.$convenio_id.'/fatura/'.$e->id) ]}">JSON resource </a>
					</td>
					@foreach($header as $h)
						@if($h[1]==1)
							<td>{[$e->$h[0]]}</td>
						@endif
					@endforeach
				</tr>
			@endforeach
		</table>
	</div>
</body>
