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


/**
* ---------------------------------------------------------------------------------
* Temporary routes: next routes contain TEMPORARY
* ---------------------------------------------------------------------------------
* VIEWS for project cacambas.
* THESE ROUTES CAN BE REMOVED FROM THE ORIGINAL PROJECT
* 
*/
Route::get('/myproduction', function()
{
	$st_r=new StandardResponse;
	$allviews=$st_r->allviews();
	return View::make('hello',compact('allviews'));
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


Route::resource('compras', 'ComprasController');
Route::resource('contabancaria', 'ContabancariaController');
Route::controller('contaempresa', 'ContabancariaEmpresaController');
Route::resource('convenio', 'ConvenioController');
Route::resource('empresa', 'EmpresaController');
Route::resource('funcionario', 'FuncionarioController');
Route::resource('endereco','EnderecoController');
Route::resource('fatura', 'FaturaController');
Route::resource('limite', 'LimiteController');
Route::resource('plano', 'PlanoController');
Route::resource('produto', 'ProdutoController');
Route::resource('resumoatividade', 'ResumoatividadeController');
Route::resource('resumoempresacliente', 'ResumoempresaclienteController');
Route::resource('resumofinanceiro', 'ResumofinanceiroController');
Route::resource('bairro', 'BairroController');
Route::resource('cidade', 'CidadeController');
Route::resource('estado', 'EstadoController');


//nested controllers
Route::resource('empresa.fatura', 'EmpresaFaturaController');
Route::resource('funcionario.resumoatividade', 'FuncionarioResumoatividadeController');
Route::resource('convenio.fatura', 'ConvenioFaturaController');


//temporary routes, can be removed on original project
Route::get('visiblecompras','ComprasController@visible');
Route::get('visiblecontabancaria','ContabancariaController@visible');
Route::get('visibleconvenio','ConvenioController@visible');
Route::get('visibleempresa','EmpresaController@visible');
Route::get('visibleendereco','EnderecoController@visible');
Route::get('visiblefatura','FaturaController@visible');
Route::get('visiblelimite','LimiteController@visible');
Route::get('visibleplano','PlanoController@visible');
Route::get('visibleproduto','ProdutoController@visible');
Route::get('visibleresumoatividade','ResumoatividadeController@visible');
Route::get('visibleresumoempresacliente','ResumoempresaclienteController@visible');
Route::get('visibleresumofinanceiro','ResumofinanceiroController@visible');
Route::get('visiblefuncionario','FuncionarioController@visible');
Route::get('visiblebairro','BairroController@visible');
Route::get('visiblecidade','CidadeController@visible');
Route::get('visibleestado','EstadoController@visible');
