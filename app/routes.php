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


// Route for make the AngularJS App
Route::get('/', array('as' => 'app.view', function (){
    return //1
    View::make('app')
    ;
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
Route::get('/myproduction', function() use ($st_r)
{
	$allviews=$st_r->allviews();
	return View::make('viewindex',compact('allviews'));
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

Route::get('/login',  array('as' => 'login.index',         'uses' => 'LoginController@index'));
//Route::get('fatura/empresa');



foreach ($st_r->allviews() as  $v) {
	//Resful resource routes
	Route::resource($v, ucfirst($v).'Controller');

	//temporary routes, not required in original project
	Route::get('visible'.$v, ucfirst($v).'Controller@visible');
	Route::get('showvisible'.$v.'/{id}', ucfirst($v).'Controller@showvisible');
}

//nested controllers
Route::resource('empresa.fatura', 'EmpresaFaturaController');
Route::resource('funcionario.resumoatividade', 'FuncionarioResumoatividadeController');
Route::resource('convenio.fatura', 'ConvenioFaturaController');

Route::resource('empresa.resumoempresacliente', 'EmpresaResumoempresaclienteController');
Route::get('empresa/{id_empresa}/visibleresumoempresacliente','EmpresaResumoempresaclienteController@visible');
Route::get('empresa/{id_empresa}/showvisibleresumoempresacliente/{id}','EmpresaResumoempresaclienteController@showvisible');





