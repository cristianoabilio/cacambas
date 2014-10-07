<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
index


<br>
<br>
<a href="{[URL::to('limite/create')]}">Add new "limite"</a>
<br>

 <table>
 	<!-- $h var comes from controller limite, containing
 	the header names on table limite -->
 	@foreach($header as $h)
		@if($h[1]==1)
			<th>
				{[$h[0]  ]}
			</th>
		@endif
	@endforeach

	@foreach($limite as $e)
		<tr>
			@foreach($header as $h)
				@if($h[1]==1)
					<td>
						@if($h[0]=='motoristas')
						<a href="{[URL::to('limite/'.$e->id)]}">{[$e->$h[0]  ]}</a>
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

