<?php
/**
* Original cacambas.com routes
*/
// Route for make the AngularJS App
Route::get('/', array('as' => 'app.view', function (){
    return View::make('app');
}));





//Standard response instantiantion for creating all 
//views and routes.
$st_r=new StandardResponse;

/**
* ---------------------------------------------------------------------------------
* Temporary routes: next routes contain TEMPORARY
* ---------------------------------------------------------------------------------
* VIEWS for project cacambas.
* THESE ROUTES CAN BE REMOVED FROM THE ORIGINAL PROJECT
* 
*/

//The "start" route temporarily works as a redirection path for
//unauthorized access.  THIS ROUTE REPRESENTS A MAJOR SECURITY
//RISK SINCE ANY USER CAN LOGIN AS A SUPERADMINISTRATOR, HAVING
//ACCESS TO ANY SECURED RESOURCE!!!
Route::get('/start',function(){
	return View::make('tempviews.start');
});


Route::get('/myproduction', function() use ($st_r)
{
	$allviews			=$st_r->allviews();
	$empresanested		=$st_r->empresa_nested();
	$equipamentonested	=$st_r->empresaequipamento_nested();
	$empresaloginnested	=$st_r->empresalogin_nested();
	$convenionested		=$st_r->empresaconvenio_nested();
	$funcionarionested	=$st_r->empresafuncionario_nested();
	$clientenested		=$st_r->empresacliente_nested();
	$classenested		=$st_r->classe_nested();
	$estadonested		=$st_r->estado_nested();
	$estadocidadenested	=$st_r->estadocidade_nested();
	$estadocidadebairronested=$st_r->estadocidadebairro_nested();
	$estadocidadebairroenderecobasenested=$st_r->estadocidadebairroenderecobase_nested();
	$estadocidadebairroenderecobaseendereconested=$st_r->estadocidadebairroenderecobaseendereco_nested();
	return View::make(
		'viewindex',
		compact(
			'allviews',
			'empresanested',
			'equipamentonested',
			'empresaloginnested',
			'convenionested',
			'funcionarionested',
			'clientenested',
			'classenested',
			'estadonested',
			'estadocidadenested',
			'estadocidadebairronested',
			'estadocidadebairroenderecobasenested',
			'estadocidadebairroenderecobaseendereconested'
			)
		)
	;
});

Route::get('/jsontest',function(){
	return View::make('tempviews.jsonchecker');
})
;

Route::controller('fakelogin','FakeloginController');

Route::get('dologin',function(){
	return View::make('tempviews.login.login');
});
Route::post('dologin','LoginController@doLogin');
Route::get('session','LoginController@getSession');
Route::get('allusers','LoginController@index');
Route::get('userslist','LoginController@visible');
Route::get('currentuser','LoginController@logged');
Route::get('login/{login}','LoginController@show');
Route::get('showvisiblelogin/{login}','LoginController@showvisible');
/**
* ---------------------------------------------------------------------------------
* End of temporary routes.
* ---------------------------------------------------------------------------------
*/

/*Fake routes: no auth set yet*/

Route::get('/login',  array('as' => 'login.index', 'uses' => 'LoginController@index'));
//Route::get('fatura/empresa');



foreach ($st_r->allviews() as  $v) {
	//Resful resource routes
	Route::resource($v, ucfirst($v).'Controller');

	//temporary routes, not required in original project
	Route::get('visible'.$v, ucfirst($v).'Controller@visible');
	Route::get('showvisible'.$v.'/{'.$v.'}', ucfirst($v).'Controller@showvisible');
}


//Reactivate status (softdelete restore)
$softdelete=array(
	'classe',
	'custo',
	'equipamento',
	'produto',
	'caminhao2'
	)
;
foreach ($softdelete as $s) {
	Route::post('/showvisible'.$s.'/{'.$s.'}', ucfirst($s).'Controller@reactivate');
}


//nested softdelete reactivate methods
$nestedsoftdelete=array(
	'classe|subclasse',
	'empresa|custo',
	'empresa|caminhao'
	)
;
foreach ($nestedsoftdelete as $n) {
	$n=explode('|',$n);
	Route::post($n[0].'/{'.$n[0].'}/showvisible'.$n[1].'/{'.$n[1].'}', ucfirst($n[0]).ucfirst($n[1]).'Controller@reactivate');
}

//standalone softdelete reactivate methods
Route::post('showvisibleempresaclienteanotacoes/{empresaclienteanotacoes}', 'EmpresaClienteAnotacoesController@reactivate');






/**
* ---------------------------------------------------------------------------------
* NESTED CONTROLLERS
* ---------------------------------------------------------------------------------
*
*/




//Nested controllers on empresa
Route::group(
	array(
		'before'=>'empresa|empresarestricted',
		//'prefix'=>'empresa'
		),function() use($st_r) {
	foreach ($st_r->empresa_nested() as $k=>$v) {
		Route::resource('empresa.'.$v, $k);
		Route::get('empresa/{empresa}/visible'.$v, $k.'@visible');
		Route::get('empresa/{empresa}/showvisible'.$v.'/{'.$v.'}',$k.'@showvisible');			
	}
});


Route::resource('empresa.login.notificacao', 'NotificationController');
Route::resource('empresa.login.conversa', 'ConversaController');
Route::resource('empresa.login.mensagem', 'MensagemController');
Route::resource('empresa.login.conversagrupo', 'ConversaGrupoCOntroller');		
	

//Nested controllers on empresa.convenio
foreach ($st_r->empresaconvenio_nested() as $k => $v) {
	Route::resource('empresa.convenio.'.$v, $k);
	Route::get('empresa/{empresa}/convenio/{convenio}/visible'.$v, $k.'@visible');
	Route::get('empresa/{empresa}/convenio/{convenio}/showvisible'.$v.'/{'.$v.'}',$k.'@showvisible');
}

//Nested controllers on empresa.equipamento
foreach ($st_r->empresaequipamento_nested() as $k => $v) {
	Route::resource('empresa.equipamento.'.$v, $k);
	Route::get('empresa/{empresa}/equipamento/{equipamento}/visible'.$v, $k.'@visible');
	Route::get('empresa/{empresa}/equipamento/{equipamento}/showvisible'.$v.'/{'.$v.'}',$k.'@showvisible');
}


//Nested controllers on empresa.funcionario
foreach ($st_r->empresafuncionario_nested() as $k => $v) {
	Route::resource('empresa.funcionario.'.$v, $k);
	Route::get('empresa/{empresa}/funcionario/{funcionario}/visible'.$v, $k.'@visible');
	Route::get('empresa/{empresa}/funcionario/{funcionario}/showvisible'.$v.'/{'.$v.'}',$k.'@showvisible');
	// geolocation
	Route::get('empresa/{empresa}/funcionario/{funcionario}/geolocalizacao/{inicio?}/{fim?}/{hora_inicio?}/{hora_fim?}', 'GeolocationController@index');
		
}

//Nested controllers on empresa.cliente
foreach ($st_r->empresacliente_nested() as $k => $v) {
	Route::resource('empresa.cliente.'.$v, $k);
	Route::get('empresa/{empresa}/cliente/{cliente}/visible'.$v, $k.'@visible');
	Route::get('empresa/{empresa}/cliente/{cliente}/showvisible'.$v.'/{'.$v.'}',$k.'@showvisible');
}

//Nested controllers on empresa.login
/*foreach ($st_r->empresalogin_nested() as $k => $v) {
	Route::resource('empresa.login.'.$v, $k);
	Route::get('empresa/{empresa}/login/{login}/visible'.$v, $k.'@visible');
	Route::get('empresa/{empresa}/login/{login}/showvisible'.$v.'/{'.$v.'}',$k.'@showvisible');
}*/


//Nested controllers on classe
foreach ($st_r->classe_nested() as $k=>$v) {
	Route::resource('classe.'.$v, $k);
	Route::get('classe/{classe}/visible'.$v, $k.'@visible');
	Route::get('classe/{classe}/showvisible'.$v.'/{'.$v.'}',$k.'@showvisible');
	//Route::post('classe/{classe}/showvisible'.$v.'/{id}',$k.'@reactivate');
}


//Nested controllers on estado
foreach ($st_r->estado_nested() as $k=>$v) {
	Route::resource('estado.'.$v, $k);
	Route::get('estado/{estado}/visible'.$v, $k.'@visible');
	Route::get('estado/{estado}/showvisible'.$v.'/{id}',$k.'@showvisible');
}

//Nested controllers on estado.cidade
foreach ($st_r->estadocidade_nested() as $k=>$v) {
	Route::resource('estado.cidade.'.$v, $k);
	Route::get('estado/{estado}/cidade/{cidade}/visible'.$v, $k.'@visible');
	Route::get('estado/{estado}/cidade/{cidade}/showvisible'.$v.'/{'.$v.'}',$k.'@showvisible');
}

//Nested controllers on estado.cidade.bairro
foreach ($st_r->estadocidadebairro_nested() as $k=>$v) {
	Route::resource('estado.cidade.bairro.'.$v, $k);
	Route::get('estado/{estado}/cidade/{cidade}/bairro/{bairro}/visible'.$v, $k.'@visible');
	Route::get('estado/{estado}/cidade/{cidade}/bairro/{bairro}/showvisible'.$v.'/{'.$v.'}',$k.'@showvisible');
}

//Nested controllers on estado.cidade.bairro.enderecobase
foreach ($st_r->estadocidadebairroenderecobase_nested() as $k=>$v) {
	Route::resource('estado.cidade.bairro.enderecobase.'.$v, $k);
	Route::get('estado/{estado}/cidade/{cidade}/bairro/{bairro}/enderecobase/{enderecobase}/visible'.$v, $k.'@visible');
	Route::get('estado/{estado}/cidade/{cidade}/bairro/{bairro}/enderecobase/{enderecobase}/showvisible'.$v.'/{'.$v.'}',$k.'@showvisible');
}

//Nested controllers on estado.cidade.bairro.enderecobase.endereco
foreach ($st_r->estadocidadebairroenderecobaseendereco_nested() as $k=>$v) {
	Route::resource('estado.cidade.bairro.enderecobase.endereco.'.$v, $k);
	Route::get('estado/{estado}/cidade/{cidade}/bairro/{bairro}/enderecobase/{enderecobase}/endereco/{endereco}/visible'.$v, $k.'@visible');
	Route::get('estado/{estado}/cidade/{cidade}/bairro/{bairro}/enderecobase/{enderecobase}/endereco/{endereco}/showvisible'.$v.'/{'.$v.'}',$k.'@showvisible');
}

/**
* ---------------------------------------------------------------------------------
* "Lonely" routes
* ---------------------------------------------------------------------------------
* Next routes are not associated with any resource controller.
* They might retrieve already existing methods on resource 
* controllers, but their naming conventions are not related them.
*
*/
Route::get('categorias','Classesubclassecontroller@categorias');

Route::get('categorias/create', function()
{
	$c=new ClassesubclasseController;
    return $c->create(2);
	
});

Route::get('empresa/{empresa}/funcionarioLogin','EmpresaFuncionarioController@funcionarioLogin');
Route::get('empresa/{empresa}/equipamentoprecoebase','EmpresaEquipamentobaseprecoController@Equipamentbaseandpreco');

Route::get('empresa/{empresa}/custocaminhao','EmpresaCustoController@custocaminhao');
Route::get('empresa/{empresa}/custoequipamento','EmpresaCustoController@custoequipamento');
Route::get('empresa/{empresa}/custofuncionario','EmpresaCustoController@custofuncionario');
Route::get('empresa/{empresa}/custofixed','EmpresaCustoController@custofixed');
Route::get('empresa/{empresa}/custovariable','EmpresaCustoController@custovariable');

Route::resource('geolocation', 'GeolocationController');