<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<div style='margin-left:200px'>
<h1>
	cannot create fatura from this view!
</h1>
<p>
	You must select a convenio from empresa
	
	{[ Empresa::find($empresa)->nome ]}
	a convenio first, in order to create a new fatura.
</p>
<p>
	<a href="{[URL::to('fatura')]}  ">Go back to fatura list</a>
</p>
</div>