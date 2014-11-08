<div id="form_token">{[Form::token()]}</div>
<div class="row">
	<div class="col-sm-3">
		<h3>Login faker</h3>
		<small class="text-muted">Automated login session faker</small>
		<div class="text-danger"><small>Warning: ensure removing this "php-included" file on the original project</small></div>
	</div>
	<?php 
	$userprofile=array(
		'superuser|superuser@cacambas.com',
		'empresa3user|e3@empresa.com'
		)
	;
	?>
	@foreach($userprofile as $u)
	<?php $u=explode('|', $u); ?>
	<div class="col-sm-3">
		<br>
		Profile: {[$u[0] ]}
		<br>
		Email: {[$u[1] ]}
		<br>
		<button id='fakelogin{[ $u[0] ]}' class="btn btn-default fakelogin">Activate this user</button>
	</div>
		
	@endforeach
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript">
$(function(){
	$('.fakelogin').each(function(){
		var id=$(this).attr('id');
		id=id.replace('fakelogin','');
		fakelogin(id);
	}
	)
	;

	function fakelogin(id){
		$('#fakelogin'+id).click(function(){
			var base=$('#base').html();
			var _token=$('#form_token input').val();
			$.post(
				base+'/fakelogin/login',
				{_token:_token,id:id},
				function(d){
					$('#fakelogin'+id).html(d);
				}
				)
			;
		});
	}
});
</script>



