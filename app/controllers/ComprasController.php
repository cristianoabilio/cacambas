<?php

/**
 * comprasdata class only contains data related to
 * the table Compras
 */
class comprasdata{
	/** 
	* function name: header.
	* @param header with headers of empresa table
	*/
	public function header(){
		/*
		$header= headers on table empresas
		In order to display or hide on HTML table, set as
		1 (visible) or 2 (not shown)
		*/
		$header=array(	
			array('produto_id',1)
			,array('convenio_id',1)
			,array('limite',0)
			,array('desconto_valor',0)
			,array('desconto_percentual',0)
			,array('ativado',0)
			,array('data_compra',0)
			,array('data_ativacao',0)
			,array('data_desativacao',0)
			,array('dthr_cadastro',0)
			,array('IDSessao',0)
		);	
		return $header;
	}
	
	/**
	* @param edata retrieves all data from table "empresa"
	*/
	public function edata () {
		return Compras::all();
	}

	public function show($id){
		return Compras::find($id)->first();
	}

	/**
	* @param formdata returns array with form values
	*/
	public function formdata(){

		return array(
				'produto_id'			=>Input::get('produto_id'),
				'convenio_id'			=>Input::get('convenio_id'),
				'limite'				=>Input::get('limite'),
				'desconto_valor'		=>Input::get('desconto_valor'),
				'desconto_percentual'	=>Input::get('desconto_percentual'),
				'ativado'				=>Input::get('ativado'),
				'data_compra'			=>Input::get('data_compra'),
				'data_ativacao'			=>Input::get('data_ativacao'),
				'data_desativacao'		=>Input::get('data_desativacao')
				)
		;
	}

}

class ComprasController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data=array();
		return View::make('tempviews.compras.index',$data);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$data=array();
		return View::make('tempviews.compras.create',$data);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//instantiate fake user (for empresa and sessao)
		//SHOULD BE DELETED IN ORIGINAL PROJECT
		$fake=new fake;
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$data=array();
		return View::make('tempviews.compras.show',$data);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$data=array();
		return View::make('tempviews.compras.edit',$data);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//instantiate fake user (for empresa and sessao)
		//SHOULD BE DELETED IN ORIGINAL PROJECT
		$fake=new fake;
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
