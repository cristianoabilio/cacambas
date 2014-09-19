index


<br>
<br>
<a href="{[URL::to('plano/create')]}">Add new "plano"</a>
<br>

<table>
	<!-- $h var comes from controller plano, containing
	the header names on table plano -->
	@foreach($header as $h)
		@if($h[1]==1)
			<th>
				{[$h[0]  ]}
			</th>
		@endif
	@endforeach

	@foreach($plano as $e)
		<tr>
			@foreach($header as $h)
				@if($h[1]==1)
					<td>
						@if($h[0]=='nome')
						<a href="{[URL::to('plano/'.$e->IDLimite)]}">{[$e->$h[0]  ]}</a>
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

Deleted

<table>
	<!-- $h var comes from controller plano, containing
	the header names on table plano -->
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
						<a href="{[URL::to('plano/'.$e->IDLimite)]}">{[$e->$h[0]  ]}</a>
						@else
						{[$e->$h[0]  ]}
						@endif
						
					</td>
				@endif
			@endforeach
		</tr>
	@endforeach
</table>