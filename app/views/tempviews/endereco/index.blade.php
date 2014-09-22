view with no style at all
<br>
<br>
<a href="{[URL::to('endereco/create')]}">Add new "endereco"</a>
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

	@foreach($endereco as $e)
		<tr>
			@foreach($header as $h)
				@if($h[1]==1)
					<td>
						@if($h[0]=='numero')
						<a href="{[URL::to('endereco/'.$e->id)]}">{[$e->$h[0]  ]}</a>
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

