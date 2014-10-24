<?php

class FaturaData  extends StandardResponse{
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
		$header=array(	
			array('convenio_id',1)
			,array('empresa_id',1)
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
			,array('sessao_id',0)


			)
		;	
		return $header;
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

	/**
	* @param formdata returns array with form values
	*/
	public function formatdata(){

		return array(
			'convenio_id'			=>Input::get('convenio_id'),
			'mes_referencia'		=>Input::get('mes_referencia'),
			'semestre_referencia'	=>Input::get('semestre_referencia'),
			'ano_referencia'		=>Input::get('ano_referencia'),
			'data_vencimento'		=>Input::get('data_vencimento'),
			'data_pagamento'		=>Input::get('data_pagamento'),
			'forma_pagamento'		=>Input::get('forma_pagamento'),
			'status_pagamento'		=>Input::get('status_pagamento'),
			'valor_plano'			=>Input::get('valor_plano'),
			'valor_prod_compra'		=>Input::get('valor_prod_compra'),
			'valor_prod_uso'		=>Input::get('valor_prod_uso'),
			'valor_boleto'			=>Input::get('valor_boleto'),
			'valor_total'			=>Input::get('valor_total'),
			'ajuste_tipo'			=>Input::get('ajuste_tipo'),
			'ajuste_valor'			=>Input::get('ajuste_valor'),
			'ajuste_percentual'		=>Input::get('ajuste_percentual'),
			'pagarme'				=>Input::get('pagarme'),
			'NFSe'					=>Input::get('NFSe')
			)
		;
	}

	public function validrules(){
		return array(
			'convenio_id'			=>	'required'
			,'mes_referencia'		=>	'required'
			,'semestre_referencia'	=>	'required'
			,'ano_referencia'		=>	'required'
			,'data_vencimento'		=>	'required'
			,'data_pagamento'		=>	'required'
			,'forma_pagamento'		=>	'required'
			,'status_pagamento'		=>	'required'
			,'valor_plano'			=>	'required'
			,'valor_prod_compra'	=>	'required'
			,'valor_prod_uso'		=>	'required'
			,'valor_boleto'			=>	'required'
			,'valor_total'			=>	'required'
			,'ajuste_tipo'			=>	'required'
			,'ajuste_valor'			=>	'required'
			,'ajuste_percentual'	=>	'required'
			,'pagarme'				=>	'required'
			,'NFSe'					=>	'required'
			// ,'dthr_cadastro'=> timestamp, not required
			// ,'sessao_id'=> sessao, not required
			)
		;
	}
}

class FaturaController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index () {
		$d=new FaturaData;
		return Response::json($d->edata());
	}


	/**
	* Visible action IS NOT A RESTFUL RESOURCE 
	* but is required for generating the view
	* with access links to each resource,
	* this is, the visible index page.
	* The reason of this method is because the
	* index resource will throw a JSON object
	* and no view at all.
	*/
	public function visible()
	{
		$d=new FaturaData;
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
		$fake=new fakeuser;
		$data=array(
			'empresa'=>$fake->empresa()
			)
		;
		return View::make('tempviews.fatura.create',$data);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 *
	 * DISSABLED AS IT WORKS IN NESTED convenio.fatura
	 */
	/*public function store()
	{
		//
	}*/


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show ($id) {
		$d=new FaturaData;
		return $d->show($id);
	}
	public function showvisible($id)
	{
		$d=new FaturaData;
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
		$d=new FaturaData;
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
		//instantiate fake user (for empresa and sessao)
		//SHOULD BE DELETED IN ORIGINAL PROJECT
		$fake=new fakeuser;
		//
		$d=new FaturaData;
		$success=$d->formatdata();
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

			$e=Fatura::find($id);	
			$e->empresa_id			=$fake->empresa();
			//
			foreach ($success as $key => $value) {
				$e->$key 	=$value;
			}
			//
			$e->dthr_cadastro		=date('Y-m-d H:i:s');
			$e->sessao_id			=$fake->sessao_id();
			//$e->sessao_id	=$this->id_sessao;
			$e->save();	

			$res=$d->responsedata(
				'Fatura',
				true,
				'update',
				$success
				)
			;
			$code=200;
		}
		catch (Exception $e){
			SysAdminHelper::NotifyError($e->getMessage());
			$res=$d->responsedata(
				'Fatura',
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
	/*
	//Delete action dissabled for "Fatura"
	public function destroy($id)
	{
		//
	}*/


}
