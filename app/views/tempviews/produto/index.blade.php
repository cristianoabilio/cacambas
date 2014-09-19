index


<br>
<br>
<a href="{[URL::to('produto/create')]}">Add new "produto"</a>
<br>

<table>
	<!-- $h var comes from controller produto, containing
	the header names on table produto -->
	@foreach($header as $h)
		@if($h[1]==1)
			<th>
				{[$h[0]  ]}
			</th>
		@endif
	@endforeach

	@foreach($produto as $e)
		<tr>
			@foreach($header as $h)
				@if($h[1]==1)
					<td>
						@if($h[0]=='nome')
						<a href="{[URL::to('produto/'.$e->IDProduto)]}">{[$e->$h[0]  ]}</a>
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
	<!-- $h var comes from controller produto, containing
	the header names on table produto -->
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
						<a href="{[URL::to('produto/'.$e->IDProduto)]}">{[$e->$h[0]  ]}</a>
						@else
						{[$e->$h[0]  ]}
						@endif
						
					</td>
				@endif
			@endforeach
		</tr>
	@endforeach
</table>