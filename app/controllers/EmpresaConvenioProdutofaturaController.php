<?php
/**
 * FuncionarioData class only contains data related to
 * the table Funcionario 
 */
class EmpresaConvenioProdutofaturaData extends StandardResponse{
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
			array('data_compra',1)
			,array('data_vencimiento',0)
			,array('data_pagamento',0)
			,array('valor_subtotal',0)
			,array('valor_ajuste_tipo',0)
			,array('valor_ajuste_percentual',0)
			,array('valor_total',1)
			,array('observacao',1)
			,array('forma_pagamento',0)
			,array('status_pagamento',0)
			,array('pagarme',0)
			,array('NSFe',0)
			//,array('sessao_id',0)

		);	
		return $header;
	}
	
	/**
	* @param edata retrieves all data from table "empresa"
	*/
	public function edata ($convenio_id) {
		return Convenio::find($convenio_id)->produtofatura;
	}
	/*public function edata ($id) {
		return Funcionario::all();
	}
	*/
	public function show($id){
		return Produtofatura::find($id);
	}

	/**
	* @param formdata returns array with form values
	*/
	public function formatdata(){

		$formatdata= array(
			//'convenio_id'	=>Input::get('convenio_id'),
			//'closed'	=>Input::get('closed'),
			'data_compra'	=>Input::get('data_compra'),
			'data_vencimiento'	=>Input::get('data_vencimiento'),
			'data_pagamento'	=>Input::get('data_pagamento'),
			'valor_subtotal'	=>Input::get('valor_subtotal'),
			'valor_ajuste_tipo'	=>Input::get('valor_ajuste_tipo'),
			'valor_ajuste_percentual'	=>Input::get('valor_ajuste_percentual'),
			'valor_total'	=>Input::get('valor_total'),
			'observacao'	=>Input::get('observacao'),
			'forma_pagamento'	=>Input::get('forma_pagamento'),
			'status_pagamento'	=>Input::get('status_pagamento'),
			'pagarme'	=>Input::get('pagarme'),
			'NSFe'	=>Input::get('NSFe'),
			//'sessao_id'	=>Input::get('sessao_id')
			)
		;

		$nullable=array(
			//'login_id'	=>Input::get('login_id')
			)
		;
		foreach ($nullable as $key => $value) {
			if ( trim($value)!="" ) {
				$formdata[$key]=$value;
			}
		}


		return $formatdata;
	}

	public function validrules(){
		return array(
			'data_compra'=>	'required'
			,'data_vencimiento'=>	'required'
			,'data_pagamento'=>	'required'
			,'valor_subtotal'=>	'required'
			,'valor_ajuste_tipo'=>	'required'
			,'valor_ajuste_percentual'=>	'required'
			,'valor_total'=>	'required'
			,'observacao'=>	'required'
			,'forma_pagamento'=>	'required'
			,'status_pagamento'=>	'required'
			,'pagarme'=>	'required'
			,'NSFe'=>	'required'
			//,'sessao_id'=>	'required'

			)
		;
	}

}


class EmpresaConvenioProdutofaturaController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($empresa_id,$convenio_id)
	{
		$d=new EmpresaConvenioProdutofaturaData;
		return $d->edata($convenio_id);
	}

	public function visible($empresa_id,$convenio_id)
	{
		$d=new EmpresaConvenioProdutofaturaData;
		$header=$d->header();
		$produtofatura=$d->edata($convenio_id);
		return View::make(
			'tempviews.EmpresaConvenioProdutofatura.index',
			compact(
				'header',
				'produtofatura',
				'empresa_id',
				'convenio_id'
				)
			)
		;
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($empresa_id,$convenio_id)
	{
		return View::make(
			'tempviews.EmpresaConvenioProdutofatura.create',
			compact(
				'empresa_id',
				'convenio_id'
				)
			);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($empresa_id,$convenio_id)
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($empresa_id,$convenio_id,$id)
	{
		//
	}

	public function showvisible($empresa_id,$convenio_id,$id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($empresa_id,$convenio_id,$id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($empresa_id,$convenio_id,$id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($empresa_id,$convenio_id,$id)
	{
		//
	}


}
