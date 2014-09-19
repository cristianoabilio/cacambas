<?php

class faturadata{
	/** 
	* function name: header.
	* @param header with headers of fatura table
	*/
	public function header(){
		/*
		$enderecoheader= headers on table enderecos
		In order to display or hide on HTML table, set as
		1 (visible) or 2 (not shown)
		*/
		$faturaheader=array(	
			array('IDConvenio',1)
			,array('IDEmpresa',1)
			,array('mes_referencia',0)
			,array('semestre_referencia',0)
			,array('ano_referencia',0)
			,array('data_vencimento',0)
			,array('data_pagamento',0)
			,array('forma_pagamento',0)
			,array('status_pagamento',0)
			,array('valor_plano',0)
			,array('valor_prod_compra',0)
			,array('valor_prod_uso',0)
			,array('valor_boleto',0)
			,array('valor_total',0)
			,array('ajuste_tipo',0)
			,array('ajuste_valor',0)
			,array('ajuste_percentual',0)
			,array('pagarme',0)
			,array('NFSe',0)
			,array('dthr_cadastro',0)
			,array('IDSessao',0)


			)
		;	
		return $faturaheader;
	}
	
	/**
	* @param edata retrieves all data from table "limite"
	*/
	public function edata () {
		return Fatura::all();
	}

	public function show($id){
		return Fatura::find($id);
	}
}

class FaturaController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$d=new faturadata;
		$data=array(
			'fatura'=>$d->edata(),
			'header'=>$d->header()
			)
		;
		return View::make('tempviews.fatura.index',$data);
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('tempviews.fatura.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		try{
			$validator= Validator::make(		
				Input::All(),	
				array(	
					'IDConvenio'=>	'required'
					,'IDEmpresa'=>	'required'
					,'mes_referencia'=>	'required'
					,'semestre_referencia'=>	'required'
					,'ano_referencia'=>	'required'
					,'data_vencimento'=>	'required'
					,'data_pagamento'=>	'required'
					,'forma_pagamento'=>	'required'
					,'status_pagamento'=>	'required'
					,'valor_plano'=>	'required'
					,'valor_prod_compra'=>	'required'
					,'valor_prod_uso'=>	'required'
					,'valor_boleto'=>	'required'
					,'valor_total'=>	'required'
					,'ajuste_tipo'=>	'required'
					,'ajuste_valor'=>	'required'
					,'ajuste_percentual'=>	'required'
					,'pagarme'=>	'required'
					,'NFSe'=>	'required'
					,'dthr_cadastro'=>	'required'
					,'IDSessao'=>	'required'
					),
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

			$e=new Fatura;	
			$e->IDConvenio			=Input::get('IDConvenio');
			$e->IDEmpresa			=Input::get('IDEmpresa');
			$e->mes_referencia		=Input::get('mes_referencia');
			$e->semestre_referencia	=Input::get('semestre_referencia');
			$e->ano_referencia		=Input::get('ano_referencia');
			$e->data_vencimento		=Input::get('data_vencimento');
			$e->data_pagamento		=Input::get('data_pagamento');
			$e->forma_pagamento		=Input::get('forma_pagamento');
			$e->status_pagamento	=Input::get('status_pagamento');
			$e->valor_plano			=Input::get('valor_plano');
			$e->valor_prod_compra	=Input::get('valor_prod_compra');
			$e->valor_prod_uso		=Input::get('valor_prod_uso');
			$e->valor_boleto		=Input::get('valor_boleto');
			$e->valor_total			=Input::get('valor_total');
			$e->ajuste_tipo			=Input::get('ajuste_tipo');
			$e->ajuste_valor		=Input::get('ajuste_valor');
			$e->ajuste_percentual	=Input::get('ajuste_percentual');
			$e->pagarme				=Input::get('pagarme');
			$e->NFSe				=Input::get('NFSe');
			$e->dthr_cadastro		=Input::get('dthr_cadastro');
			$e->IDSessao			=Input::get('IDSessao');
			$e->save();	


			$res=$res = array(
				'status'=>'success',
				'msg' => 'SUCCESFULLY SAVED!'
				)
			;


		} catch (Exception $e){
			SysAdminHelper::NotifyError($e->getMessage());
			$res = array('status'=>'error','msg' => json_decode($e->getMessage()));
		}
		return Response::json($res);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$d=new faturadata;
		$data=array(
			'header'=>$d->header(),
			'fatura'=>$d->show($id),
			'id'=>$id
			)
		;
		return View::make('tempviews.fatura.show',$data);

	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$d=new faturadata;
		$data=array(
			'header'=>$d->header(),
			'fatura'=>$d->show($id),
			'id'=>$id
			)
		;
		return View::make('tempviews.fatura.edit',$data);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		try{
			$validator= Validator::make(			
				Input::All(),	
				array(	
					'IDConvenio'=>				'required'
					,'IDEmpresa'=>				'required'
					,'mes_referencia'=>			'required'
					,'semestre_referencia'=>	'required'
					,'ano_referencia'=>			'required'
					,'data_vencimento'=>		'required'
					,'data_pagamento'=>			'required'
					,'forma_pagamento'=>		'required'
					,'status_pagamento'=>		'required'
					,'valor_plano'=>			'required'
					,'valor_prod_compra'=>		'required'
					,'valor_prod_uso'=>			'required'
					,'valor_boleto'=>			'required'
					,'valor_total'=>			'required'
					,'ajuste_tipo'=>			'required'
					,'ajuste_valor'=>			'required'
					,'ajuste_percentual'=>		'required'
					,'pagarme'=>				'required'
					,'NFSe'=>					'required'
					,'dthr_cadastro'=>			'required'
					,'IDSessao'=>				'required'

					),	
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

			$e=Fatura::find($id);	
			$e->IDConvenio			=Input::get('IDConvenio');
			$e->IDEmpresa			=Input::get('IDEmpresa');
			$e->mes_referencia		=Input::get('mes_referencia');
			$e->semestre_referencia	=Input::get('semestre_referencia');
			$e->ano_referencia		=Input::get('ano_referencia');
			$e->data_vencimento		=Input::get('data_vencimento');
			$e->data_pagamento		=Input::get('data_pagamento');
			$e->forma_pagamento		=Input::get('forma_pagamento');
			$e->status_pagamento	=Input::get('status_pagamento');
			$e->valor_plano			=Input::get('valor_plano');
			$e->valor_prod_compra	=Input::get('valor_prod_compra');
			$e->valor_prod_uso		=Input::get('valor_prod_uso');
			$e->valor_boleto		=Input::get('valor_boleto');
			$e->valor_total			=Input::get('valor_total');
			$e->ajuste_tipo			=Input::get('ajuste_tipo');
			$e->ajuste_valor		=Input::get('ajuste_valor');
			$e->ajuste_percentual	=Input::get('ajuste_percentual');
			$e->pagarme				=Input::get('pagarme');
			$e->NFSe				=Input::get('NFSe');
			$e->dthr_cadastro		=Input::get('dthr_cadastro');
			$e->IDSessao			=Input::get('IDSessao');
			$e->save();	

			$res=$res = array(
				'status'=>'success',
				'msg' => 'SUCCESFULLY UPDATED!'
				)
			;
		}
		catch (Exception $e){
			SysAdminHelper::NotifyError($e->getMessage());
			$res = array('status'=>'error','msg' => json_decode($e->getMessage()));
		}
		return Response::json($res);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	/*public function destroy($id)
	{
		//
	}*/


}
