<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


//Standard response instantiantion for creating all 
//views and routes.
$st_r=new StandardResponse;

// Route for make the AngularJS App
Route::get('/', array('as' => 'app.view', function(){
	
    return //1
    View::make('app')
    ;
}));


/**
* ---------------------------------------------------------------------------------
* Temporary routes: next routes contain TEMPORARY
* ---------------------------------------------------------------------------------
* VIEWS for project cacambas.
* THESE ROUTES CAN BE REMOVED FROM THE ORIGINAL PROJECT
* 
*/
Route::get('/myproduction', function() use ($st_r)
{
	$allviews			=$st_r->allviews();
	$empresanested		=$st_r->empresa_nested();
	$convenionested		=$st_r->empresaconvenio_nested();
	$funcionarionested	=$st_r->empresafuncionario_nested();
	$classenested		=$st_r->classe_nested();
	$estadonested		=$st_r->estado_nested();
	$estadocidadenested	=$st_r->estadocidade_nested();
	return View::make(
		'viewindex',
		compact(
			'allviews',
			'empresanested',
			'convenionested',
			'funcionarionested',
			'classenested',
			'estadonested',
			'estadocidadenested'
			)
		)
	;
});

Route::get('/jsontest',function(){
	return View::make('tempviews.jsonchecker');
})
;
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
	Route::get('showvisible'.$v.'/{id}', ucfirst($v).'Controller@showvisible');
}


/**
* ---------------------------------------------------------------------------------
* NESTED CONTROLLERS
* ---------------------------------------------------------------------------------
*
*/

//Nested controllers on empresa
foreach ($st_r->empresa_nested() as $k=>$v) {
	Route::resource('empresa.'.$v, $k);
	Route::get('empresa/{empresa}/visible'.$v, $k.'@visible');
	Route::get('empresa/{empresa}/showvisible'.$v.'/{id}',$k.'@showvisible');
}

//Nested controllers on empresa.convenio
foreach ($st_r->empresaconvenio_nested() as $k => $v) {
	Route::resource('empresa.convenio.'.$v, $k);
	Route::get('empresa/{empresa}/convenio/{convenio}/visible'.$v, $k.'@visible');
	Route::get('empresa/{empresa}/convenio/{convenio}/showvisible'.$v.'/{id}',$k.'@showvisible');
}


//Nested controllers on empresa.funcionario
foreach ($st_r->empresafuncionario_nested() as $k => $v) {
	Route::resource('empresa.funcionario.'.$v, $k);
	Route::get('empresa/{empresa}/funcionario/{funcionario}/visible'.$v, $k.'@visible');
	Route::get('empresa/{empresa}/funcionario/{funcionario}/showvisible'.$v.'/{id}',$k.'@showvisible');
}


//Nested controllers on classe
foreach ($st_r->classe_nested() as $k=>$v) {
	Route::resource('classe.'.$v, $k);
	Route::get('classe/{classe}/visible'.$v, $k.'@visible');
	Route::get('classe/{classe}/showvisible'.$v.'/{id}',$k.'@showvisible');
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

