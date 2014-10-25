<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Cacambas temporal view</title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
	<div class="container">
		
		<h1>Temporary RESTfull controllers tester.</h1>

		<br>
		<table class="table table-condensed">
			<tr>
				<th>indexes as HTML views</th>
				<th>indexes as JSON responses</th>
				<th>Index url</th>
				<th>Show url</th>
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
		<h4>nested on convenio</h4>
		<small class="text-muted">
			In order to see resources you must choose an empresa and 
			convenio resource first:  
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
		<h4>nested on funcionario</h4>
		<small class="text-muted">
			In order to see resources you must choose an empresa and 
			a funcionario resource first:  
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
			In order to see resources you must choose an classe first:  
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
		<hr>
		<br>
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
