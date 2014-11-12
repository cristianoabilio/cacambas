<div id="form_token">{[Form::token()]}</div>
<div class="row">
	<div class="col-sm-12">
		@if(Auth::check())
		Note: if you see this message user is logged with next attributes:
		<ul>
			<li>
				User: {[Auth::user()->nome]}
			</li>
			<li>
				Profile: 
				@foreach(Auth::user()->perfil as $p)
					- {[$p->nome]}
				@endforeach
			</li>
			<li>
				Company: {[Auth::user()->empresa->nome]} ({[Auth::user()->empresa->id]})
			</li>
		</ul>
		@endif
		<?php 
		$perfil=array('admin_cacambas');
		echo !in_array('admin_cacambas', $perfil);
		 ?>
	</div>
</div>
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
<div class="row">
	<div class="col-sm-12">
		<a href="{[URL::to('fakelogin/logout')]}">Log out</a>
		-{[!Auth::check()]}-
	</div>
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
			id=id.replace('fakelogin','');
			$.post(
				base+'/fakelogin/login',
				{_token:_token,id:id},
				function(d){
					if (d==1) {
						window.location.href=base+'/myproduction';
					}
				}
				)
			;
		});
	}
});
</script>



