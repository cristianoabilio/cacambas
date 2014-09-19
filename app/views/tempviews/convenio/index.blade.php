index


<br>
<br>
<a href="{[URL::to('convenio/create')]}">Add new "convenio"</a>
<br>

<table>
	<!-- $h var comes from controller convenio, containing
	the header names on table convenio -->
	@foreach($header as $h)
		@if($h[1]==1)
			<th>
				{[$h[0]  ]}
			</th>
		@endif
	@endforeach

	@foreach($convenio as $e)
		<tr>
			@foreach($header as $h)
				@if($h[1]==1)
					<td>
						@if($h[0]=='IDEmpresa')
						<a href="{[URL::to('convenio/'.$e->IDConvenio)]}">{[$e->$h[0]  ]}</a>
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
