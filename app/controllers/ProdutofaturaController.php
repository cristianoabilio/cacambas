<?php

class ProdutofaturaData extends StandardResponse{
	public function header(){
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
			)
		;	
		return $header;
	}

	/**
	* @return edata retrieves all "fatura" related to "convenio"
	*/
	public function edata(){
		return Produtofatura::all();
	}

	public function show ($id) {
		return Produtofatura::find($id);
	}

	public function formatdata(){
		$formdata=array(
			'data_compra'		=>Input::get('data_compra'),
			'data_vencimiento'	=>Input::get('data_vencimiento'),
			'data_pagamento'	=>Input::get('data_pagamento'),
			'valor_subtotal'	=>Input::get('valor_subtotal'),
			'valor_ajuste_tipo'	=>Input::get('valor_ajuste_tipo'),
			'valor_ajuste_percentual'	=>Input::get('valor_ajuste_percentual'),
			'valor_total'		=>Input::get('valor_total'),
			'observacao'		=>Input::get('observacao'),
			'forma_pagamento'	=>Input::get('forma_pagamento'),
			'status_pagamento'	=>Input::get('status_pagamento'),
			'pagarme'			=>Input::get('pagarme'),
			'NSFe'				=>Input::get('NSFe'),
			)
		;
		return $formdata;
	}

	public function validrules() {
		return array(
			'data_compra'			=>	'required'
			,'data_vencimiento'		=>	'required'
			,'data_pagamento'		=>	'required'
			,'valor_subtotal'		=>	'required'
			,'valor_ajuste_tipo'	=>	'required'
			,'valor_ajuste_percentual'=>'required'
			,'valor_total'			=>	'required'
			//,'observacao'			=>	'required'
			,'forma_pagamento'		=>	'required'
			,'status_pagamento'		=>	'required'
			,'pagarme'				=>	'required'
			,'NSFe'					=>	'required'
			)
		;
	}

}

class ProdutofaturaController extends \BaseController {

	public function __construct(){
		$this->beforeFilter('csrf', array('on' => 'post'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$d=new ProdutofaturaData;
		return $d->edata();
	}

	public function visible () {
		$d=new ProdutofaturaData;
		$header=$d->header();
		$produtofatura=$d->edata();
		return View::make(
			'tempviews.produtofatura.index',
			compact(
				'header',
				'produtofatura'
				)
			)
		;
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make(
			'tempviews.produtofatura.create'
			)
		;
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
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
		$d=new ProdutofaturaData;
		return $d->show($id);
	}

	public function showvisible($id){
		$d=new ProdutofaturaData;
		$header=$d->header();
		$produtofatura=$d->show($id);
		return View::make(
			'tempviews.produtofatura.show',
			compact(
				'header',
				'produtofatura',
				'id'
				)
			)
		;
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$d=new ProdutofaturaData;
		
		$produtofatura=$d->show($id);
		return View::make(
			'tempviews.produtofatura.edit',
			compact(
				'produtofatura',
				'id'
				)
			)
		;
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
		$fake=new fakeuser;

		$d=new ProdutofaturaData;

		$success= $d->formatdata();

		try{
			$validator= Validator::make(			
				Input::All(),
				$d->validrules(),	
				array(		
					'required'=>'Required field'	
					)	
				)		
			;

			if ($validator->fails()){
				throw new Exception(
					json_encode(
						array(
							'validation_errors'=>$validator->messages()->all()
							)
						)
					)
				;
			}

			//update produtofatura
			$e=Produtofatura::find($id);
			// $succes variable contains array name=>value
			//from the form required in this controller
			foreach ($success as $k => $v) {
				//
				//Skipping 'products' value
				if ($k!='products') {
					$e->$k = $v;
				}
			}

			//$e->dthr_cadastro	=date('Y-m-d H:i:s');
			$e->sessao_id		=$fake->sessao_id();
			//$e->sessao_id	=$this->id_sessao;
			$e->save();

			$res = $d->responsedata(
				'produtofatura',
				true,
				'update',
				$success
				)
			;
			$code=200;
		}
		catch(Exception $e){
			SysAdminHelper::NotifyError($e->getMessage());
			$res = $d->responsedata(
				'produtofatura',
				false,
				'update',
				$validator->messages()
				)
			;
			$code=400;
		}
		return Response::json($res,$code);
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
