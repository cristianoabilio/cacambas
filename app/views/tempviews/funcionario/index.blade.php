<?php 
$fake=new fakeuser;

 ?>
{[Empresa::find($fake->empresa())->nome ]}
<br>	
<hr>
<a href="{[URL::to('funcionario/create')]}">Add new "funcionario"</a>
<br>

 <table>
 	<!-- $h var comes from controller, containing
 	the header names on table  -->
 	<tr>
 	@foreach($header as $h)
		@if($h[1]==1)
			<th>
				{[$h[0]  ]}
			</th>
		@endif
	@endforeach
	</tr>
	@foreach($funcionario as $e)

		@if($e->status==1)
			<tr>
				@foreach($header as $h)
					@if($h[1]==1)
						<td>
							@if($h[0]=='nome')
							<a href="{[URL::to('funcionario/'.$e->id)]}">{[$e->$h[0]  ]}</a>
							@else
							{[$e->$h[0]  ]}
							@endif
							
						</td>
					@endif
				@endforeach
			</tr>
		@endif
			
	@endforeach
</table>
<br>
<br>
deleted (status=0)
 <table>
 	<!-- $h var comes from controller, containing
 	the header names on table -->
 	@foreach($header as $h)
		@if($h[1]==1)
			<th>
				{[$h[0]  ]}
			</th>
		@endif
	@endforeach

	@foreach($funcionario as $e)
		@if($e->status==0)
			<tr>
				@foreach($header as $h)
					@if($h[1]==1)
						<td>
							@if($h[0]=='nome')
							<a href="{[URL::to('funcionario/'.$e->id)]}">{[$e->$h[0]  ]}</a>
							@else
							{[$e->$h[0]  ]}
							@endif
							
						</td>
					@endif
				@endforeach
			</tr>
		@endif
			
	@endforeach
</table>