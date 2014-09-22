<?php 
$fake=new fakeuser;

 ?>
{[Empresa::find($fake->empresa())->nome ]}
<br>	
<hr>
<a href="{[URL::to('compras/create')]}">Add new "compra"</a>
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

	@foreach($compras as $e)
		<tr>
			@foreach($header as $h)
				@if($h[1]==1)
					<td>
						@if($h[0]=='produto_id')
						<a href="{[URL::to('compras/'.$e->id)]}">{[$e->$h[0]  ]}</a>
						@else
						{[$e->$h[0]  ]}
						@endif
						
					</td>
				@endif
			@endforeach
		</tr>
	@endforeach
</table>