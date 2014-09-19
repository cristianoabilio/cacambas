index


<br>
<br>
<a href="{[URL::to('fatura/create')]}">Add new "fatura"</a>
<br>

 <table>
 	<!-- $h var comes from controller fatura, containing
 	the header names on table fatura -->
 	@foreach($header as $h)
		@if($h[1]==1)
			<th>
				{[$h[0]  ]}
			</th>
		@endif
	@endforeach

	@foreach($fatura as $e)
		<tr>
			@foreach($header as $h)
				@if($h[1]==1)
					<td>
						@if($h[0]=='IDEmpresa')
						<a href="{[URL::to('fatura/'.$e->IDEmpresa)]}">{[$e->$h[0]  ]}</a>
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

