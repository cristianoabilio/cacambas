<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Cacambas temporal view</title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div id="base" class='hide'>{[URL::to('/')]}</div>
	<div class="container">
		<h1>Temporary RESTfull controllers tester.</h1>
		@include('tempviews.loginfaker')
		<br>
		<h3>Login routes and controllers</h3>
		<?php  
		$login_methods=array(
			'Login|no|LoginController@doLogin|Authenticates user',
			'Log out|no|LoginController@logout|Logs user out',
			'getSession|session|LoginController@getSession|Returns current session',
			'all users (JSON)|allusers|LoginController@index|Index JSON object',
			'Users table (HTML)|userslist|LoginController@visible|All users as HTML table',
			'logged|currentuser|LoginController@logged|currently loged user data as JSON',
			'store|no|LoginController@store|Saves new user',
			'JSON user resource|no|LoginController@show(id)|go to users table and choose resource',
			'HTML user resource|no|LoginController@showvisible(id)|go to users table and choose resource',
			'update|no|LoginController@update|Updates user (login) data',
			'destroy|no|LoginController@destroy|specify route before using'
			)
		;
		?>
		<table class="table">
			<tr>
				<th>Action</th>
				<th>test url (set definitive on routes)</th>
				<th>resource controller</th>
				<th>Comment</th>
			</tr>
			@foreach($login_methods as $l)
			<?php $l=explode('|', $l); ?>
			<tr>
				@foreach($l as $k=>$v)
				<td>
					@if($k=='1')
						@if($v=='no')
							no
						@else 
							<a href="{[URL::to($v)]}">http.../{[$v ]}</a>
						@endif
					@else
					{[$v ]}
					@endif
				</td>
				@endforeach
				
			</tr>
				
			@endforeach
		</table>
		<hr>
		<h3>No nested resources controllers</h3>
		<table class="table">
			<tr>
				<th>indexes as HTML views</th>
				<th>indexes as JSON responses</th>
				<th>Index JSON url</th>
				<th>Show JSON url</th>
			</tr>
		
			@foreach($allviews as $v)
			<tr>
				<td>
					<a href="{[URL::to('visible'.$v) ]}" >{[$v]}</a>
				</td>
				<td>
					<a href="{[URL::to($v) ]}" >json index on {[$v]}</a>
				</td>
				<td>
					 '/{[$v]}'  
				</td>
				<td>
					'/{[$v]}/{id}'
				</td>
			</tr>
			@endforeach
		</table>
		<hr>
		<h3>Nested or combined resources in same view</h3>
		<br>
		<h4>nested on empresa</h4>
		<small class="text-muted">
			In order to see resources go to 
			<a href="{[URL::to('visibleempresa')]}">empresa </a>
			and choose one first
		</small>
		<table class="table">
			<tr>
				<th>index name</th>
				<th>Index url (as JSON view)</th>
				<th>Show url (as JSON view)</th>
			</tr>
		@foreach($empresanested as $n)
			<tr>
				<td>
					{[$n]}
				</td>
				<td>
					 'empresa/{empresa_id}/{[$n]}'  
				</td>
				<td>
					'empresa/{empresa_id}/{[$n]}/{id}'
				</td>
			</tr>
		@endforeach
		</table>
		<br>
		<h4>nested on empresa.convenio</h4>
		<small class="text-muted">
			In order to see resources you must choose all parent resources first:  
			<spam class="text-info">empresa/{empresa_id}/convenio/{convenio_id}/[table name]</spam>
		</small>
		<table class="table">
			<tr>
				<th>index name</th>
				<th>Index url (as JSON view)</th>
				<th>Show url (as JSON view)</th>
			</tr>
		@foreach($convenionested as $n)
			<tr>
				<td>
					{[$n]}
				</td>
				<td>
					 'empresa/{empresa_id}/convenio/{convenio_id}/{[$n]}'  
				</td>
				<td>
					'empresa/{empresa_id}/convenio/{convenio_id}/{[$n]}/{id}'
				</td>
			</tr>
		@endforeach
		</table>
		<br>
		<h4>nested on empresa.funcionario</h4>
		<small class="text-muted">
			In order to see resources you must choose all parent resources  first:  
			<spam class="text-info">empresa/{empresa_id}/funcionario/{funcionario_id}/[table name]</spam>
		</small>
		<table class="table">
			<tr>
				<th>index name</th>
				<th>Index url (as JSON view)</th>
				<th>Show url (as JSON view)</th>
			</tr>
		@foreach($funcionarionested as $n)
			<tr>
				<td>
					{[$n]}
				</td>
				<td>
					 'empresa/{empresa_id}/funcionario/{funcionario_id}/{[$n]}'  
				</td>
				<td>
					'empresa/{empresa_id}/funcionario/{funcionario_id}/{[$n]}/{id}'
				</td>
			</tr>
		@endforeach
		</table>
		<br>
		<h4>nested on classe</h4>
		<small class="text-muted">
			In order to see resources you must choose all parent resources first:  
			<spam class="text-info">classe/{classe_id}/[table name]</spam>
		</small>
		<table class="table">
			<tr>
				<th>index name</th>
				<th>Index url (as JSON view)</th>
				<th>Show url (as JSON view)</th>
			</tr>
		@foreach($classenested as $n)
			<tr>
				<td>
					{[$n]}
				</td>
				<td>
					 'classe/{classe_id}/{[$n]}'  
				</td>
				<td>
					'classe/{classe_id}//{[$n]}/{id}'
				</td>
			</tr>
		@endforeach
		</table>
		<br>
		<h4>nested on Estado</h4>
		<small class="text-muted">
			In order to see resources you must choose all parent resources first:  
			<spam class="text-info">estado/{estado_id}/[table name]</spam>
		</small>
		<table class="table">
			<tr>
				<th>index name</th>
				<th>Index url (as JSON view)</th>
				<th>Show url (as JSON view)</th>
			</tr>
		@foreach($estadonested as $n)
			<tr>
				<td>
					{[$n]}
				</td>
				<td>
					 'estado/{estado_id}/{[$n]}'  
				</td>
				<td>
					'estado/{estado_id}//{[$n]}/{id}'
				</td>
			</tr>
		@endforeach
		</table>
		<br>
		<h4>nested on Estado.Cidade</h4>
		<small class="text-muted">
			In order to see resources you must choose all parent resources first:  
			<spam class="text-info">estado/{estado_id}/cidade/{cidade_id}/[table name]</spam>
		</small>
		<table class="table">
			<tr>
				<th>index name</th>
				<th>Index url (as JSON view)</th>
				<th>Show url (as JSON view)</th>
			</tr>
		@foreach($estadocidadenested as $n)
			<tr>
				<td>
					{[$n]}
				</td>
				<td>
					 'estado/{estado_id}/cidade/{cidade_id}/{[$n]}'  
				</td>
				<td>
					'estado/{estado_id}/cidade/{cidade_id}/{[$n]}/{id}'
				</td>
			</tr>
		@endforeach
		</table>
		<br>
		<h4>nested on Estado.Cidade.Bairro</h4>
		<small class="text-muted">
			In order to see resources you must choose all parent resources first:  
			<spam class="text-info">estado/{estado_id}/cidade/{cidade_id}/bairro/{bairro}/[table name]</spam>
		</small>
		<table class="table">
			<tr>
				<th>index name</th>
				<th>Index url (as JSON view)</th>
				<th>Show url (as JSON view)</th>
			</tr>
		@foreach($estadocidadebairronested as $n)
			<tr>
				<td>
					{[$n]}
				</td>
				<td>
					 'estado/{estado}/cidade/{cidade}/bairro/{bairro}/{[$n]}'  
				</td>
				<td>
					'estado/{estado}/cidade/{cidade}/bairro/{bairro}/{[$n]}/{id}'
				</td>
			</tr>
		@endforeach
		</table>
		<br>
		<h4>nested on Estado.Cidade.Bairro.Enderecobase</h4>
		<small class="text-muted">
			In order to see resources you must choose all parent resources first:  
			<spam class="text-info">estado/{estado_id}/cidade/{cidade_id}/bairro/{bairro}/enderecobase/{enderecobase}/[table name]</spam>
		</small>
		<table class="table">
			<tr>
				<th>index name</th>
				<th>Index url (as JSON view)</th>
				<th>Show url (as JSON view)</th>
			</tr>
		@foreach($estadocidadebairroenderecobasenested as $n)
			<tr>
				<td>
					{[$n]}
				</td>
				<td>
					 'estado/{estado}/cidade/{cidade}/bairro/{bairro}/enderecobase/{enderecobase}/{[$n]}'  
				</td>
				<td>
					'estado/{estado}/cidade/{cidade}/bairro/{bairro}/{[$n]}/enderecobase/{enderecobase}/{id}'
				</td>
			</tr>
		@endforeach
		</table>
		<br>
		<h4>nested on Estado.Cidade.Bairro.Enderecobase.Endereco</h4>
		<small class="text-muted">
			In order to see resources you must choose all parent resources first:  
			<spam class="text-info">estado/{estado_id}/cidade/{cidade_id}/bairro/{bairro}/enderecobase/{enderecobase}/endereco/{endereco}/[table name]</spam>
		</small>
		<table class="table">
			<tr>
				<th>index name</th>
				<th>Index url (as JSON view)</th>
				<th>Show url (as JSON view)</th>
			</tr>
		@foreach($estadocidadebairroenderecobaseendereconested as $n)
			<tr>
				<td>
					{[$n]}
				</td>
				<td>
					 'estado/{estado}/cidade/{cidade}/bairro/{bairro}/enderecobase/{enderecobase}/endereco/{endereco}/{[$n]}'  
				</td>
				<td>
					'estado/{estado}/cidade/{cidade}/bairro/{bairro}/{[$n]}/enderecobase/{enderecobase}/endereco/{endereco}/{id}'
				</td>
			</tr>
		@endforeach
		</table>
		<hr>
		<br>
		<h4>Lonely (not restfully made) routes</h4>
		<a href="{[URL::to('categorias') ]}">Categoria as JSON</a>
		<br>
		<a href="{[URL::to('categorias/create') ]}">Create new categoria</a>
		<br>
		<h3><a href="{[URL::to('jsontest') ]}">JSON checker</a></h3>
		<hr>
		<br>
		<br>
		<br>

	</div>
</body>
</html>
