<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div id="base" class="hide">{[URL::to('/')]}</div>
	<div class="container">
		<h1>login faker</h1>
		<h2 class="text-danger">Warning: this page should not be included in the real cacambas site as it contains a major security risk, allowing any user to have superuser permissions</h2>
		<h4>
			<a href="{[URL::to('/myproduction')]}">Back to main resources page</a>
		</h4>
		available users for tests
		<ul>
			<?php 
			$samepwd=array(
				'superuser',
				'empresa2user',
				'empresa3user'
				)
			;
			?>
			@foreach(Login::all() as $l)
				<li>
					{[$l->login]}
					@if(in_array($l->login, $samepwd) )
					| Password= {[$l->login]}
					@else 
					| Password= admin
					@endif
				</li>
			@endforeach
		</ul><div id="token">{[Form::token()]}</div>
		<div class="row">
			<div class="col-sm-2">
				<input type="text" id='usuario' class='form-control' placeholder='usuario'>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				<input type="password" id='senha' class='form-control' placeholder='senha'>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<button id='login' class="btn btn-default">login</button>
			</div>
		</div>
		<div id="result_here"></div>
	</div>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</body>
<script type="text/javascript">
$(function(){
	$('#login').click(function(){
		var token=$('#token input').val();
		var usuario=$('#usuario').val();
		var senha=$('#senha').val();
		var base=$('#base').html();
		$.post(base+'/dologin',{_token:token,usuario:usuario,senha:senha},function(d){
			window.location.href=base+'/myproduction';
		});
	});
});
</script>