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
		<a href="{[URL::to('convenio') ]}" >convenio (contains nested "Fatura" invoices)</a> <br>
		<a href="{[URL::to('funcionario') ]}" >funcionario (contains resumoatividade as nested)</a> <br>
		<a href="{[URL::to('plano') ]}" >plano (contains limite CRUD actions)</a> <br>
		<br>
		Nested on empresa
		<ul>
			<li>resumoempresacliente</li>
		</ul>
		
		
		<hr>
		<h3><a href="{[URL::to('jsontest') ]}">JSON checker</a></h3>
		<hr>
		<br>
		<br>
		<br>

	</div>
</body>
</html>
