<h1>
	Convenios for {[Empresa::find($empresa)->nome]}
</h1>

<br>
<br>
<a href="{[URL::to('convenio/create')]}">Add new "convenio"</a>
<br>

<table>
	<!-- $h var comes from controller convenio, containing
	the header names on table convenio -->
	<tr>
	@foreach($header as $h)
		@if($h[1]==1)
			<th>
				{[$h[0]  ]}
			</th>
		@endif
	@endforeach
	<th>Invoices</th>
	</tr>
	@foreach($convenio as $e)
		<tr>
			@foreach($header as $h)
				@if($h[1]==1)
					<td>
						@if($h[0]=='plano_id')
						<a href="{[URL::to('convenio/'.$e->id)]}">{[$e->$h[0]  ]}</a>
						@else
						{[$e->$h[0]  ]}
						@endif
						
					</td>
				@endif
			@endforeach
			<td>
				<a href="{[URL::to('convenio/'.$e->id.'/fatura')]} ">
					faturas
					(total {[Fatura::whereConvenio_id($e->id)->count() ]}  )
				</a>
			</td>
		</tr>
	@endforeach
</table>

<br>
<br>
<br>
<br>
