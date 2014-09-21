view with no style at all
<br>
<br>
<a href="{[URL::to('empresa/create')]}">Add new "empresa"</a>
<br>

 <table>
 	<!-- $h var comes from controller Empresa2, containing
 	the header names on table Empresa -->
 	@foreach($header as $h)
		@if($h[1]==1)
			<th>
				{[$h[0]  ]}
			</th>
		@endif
	@endforeach

	@foreach($empresas as $e)
		<tr>
			@foreach($header as $h)
				@if($h[1]==1)
					<td>
						@if($h[0]=='nome')
						<a href="{[URL::to('empresa/'.$e->id)]}">{[$e->$h[0]  ]}</a>
						@else
						{[$e->$h[0]  ]}
						@endif
						
					</td>
				@endif
			@endforeach
		</tr>
	@endforeach
</table>

<br>
<br>
<br>
<br>
<h1>Deleted "Empresas" (status as 0) </h1>
<table>
 	<!-- $h var comes from controller Empresa2, containing
 	the header names on table Empresa -->
 	@foreach($header as $h)
		@if($h[1]==1)
			<th>
				{[$h[0]  ]}
			</th>
		@endif
	@endforeach

	@foreach($deleted as $e)
		<tr>
			@foreach($header as $h)
				@if($h[1]==1)
					<td>
						@if($h[0]=='nome')
						<a href="{[URL::to('empresa/'.$e->id)]}">{[$e->$h[0]  ]}</a>
						@else
						{[$e->$h[0]  ]}
						@endif
						
					</td>
				@endif
			@endforeach
		</tr>
	@endforeach
</table>
