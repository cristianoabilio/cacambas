index


<br>
<br>
<a href="{[URL::to('contabancaria/create')]}">Add new "contabancaria"</a>
<br>

 <table>
 	<!-- $h var comes from controller contabancaria2, containing
 	the header names on table contabancaria -->
 	@foreach($header as $h)
		@if($h[1]==1)
			<th>
				{[$h[0]  ]}
			</th>
		@endif
	@endforeach

	@foreach($conta as $e)
		<tr>
			@foreach($header as $h)
				@if($h[1]==1)
					<td>
						@if($h[0]=='nome_banco')
						<a href="{[URL::to('contabancaria/'.$e->IDConta)]}">{[$e->$h[0]  ]}</a>
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

