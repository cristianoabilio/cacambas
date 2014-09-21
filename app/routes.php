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

Route::get('/myproduction', function()
{
	return View::make('hello');
});

/*Fake routes: no auth set yet*/

Route::get('/login',  array('as' => 'login.index',         'uses' => 'LoginController@index'));
//Route::get('fatura/empresa');


Route::resource('compras', 'ComprasController');
Route::resource('contabancaria', 'ContabancariaController');
Route::controller('contaempresa', 'ContabancariaEmpresaController');
Route::resource('convenio', 'ConvenioController');
Route::resource('empresa', 'EmpresaController');
Route::resource('endereco','EnderecoController');
Route::resource('fatura', 'FaturaController');
Route::resource('limite', 'LimiteController');
Route::resource('plano', 'PlanoController');
Route::resource('produto', 'ProdutoController');
Route::resource('resumoatividade', 'ResumoatividadeController');
Route::resource('resumoempresacliente', 'ResumoempresaclienteController');
Route::resource('resumofinanceiro', 'ResumofinanceiroController');

//nested controllers
Route::resource('empresa.fatura', 'EmpresaFaturaController');
