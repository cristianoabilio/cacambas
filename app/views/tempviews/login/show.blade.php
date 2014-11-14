<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Login (user) specifications</h1>
		@foreach($header as $h)
			<div class="row">
				<div class="col-sm-2">
					{[$h[0] ]}
				</div>
				<div class="col-sm-6 text-info">
					{[$login->$h[0]   ]}
				</div>
			</div>
		@endforeach
		<br>
		<hr>
		<br>
		<br>
		<a href="{[URL::to('userslist')]}">Back to login</a>
	</div>
</body>

		
		