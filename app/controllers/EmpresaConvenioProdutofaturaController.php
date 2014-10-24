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
			'data_compra'		=>Input::get('data_compra'),
			'data_vencimiento'	=>Input::get('data_vencimiento'),
			'data_pagamento'	=>Input::get('data_pagamento'),
			'products'			=>Input::get('products'),
			'valor_subtotal'	=>Input::get('valor_subtotal'),
			'valor_ajuste_tipo'	=>Input::get('valor_ajuste_tipo'),
			'valor_ajuste_percentual'	=>Input::get('valor_ajuste_percentual'),
			'valor_total'		=>Input::get('valor_total'),
			'observacao'		=>Input::get('observacao'),
			'forma_pagamento'	=>Input::get('forma_pagamento'),
			'status_pagamento'	=>Input::get('status_pagamento'),
			'pagarme'			=>Input::get('pagarme'),
			'NSFe'				=>Input::get('NSFe'),
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
			'data_compra'			=>	'required'
			,'data_vencimiento'		=>	'required'
			,'data_pagamento'		=>	'required'
			,'products'				=>	'required'
			,'valor_subtotal'		=>	'required'
			,'valor_ajuste_tipo'	=>	'required'
			,'valor_ajuste_percentual'=>'required'
			,'valor_total'			=>	'required'
			//,'observacao'			=>	'required'
			,'forma_pagamento'		=>	'required'
			,'status_pagamento'		=>	'required'
			,'pagarme'				=>	'required'
			,'NSFe'					=>	'required'
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
		//instantiate fake user (for empresa and sessao)
		//SHOULD BE DELETED IN ORIGINAL PROJECT
		$fake=new fakeuser;

		$d=new EmpresaConvenioProdutofaturaData;

		$success= $d->formatdata();

		try{
			$validator= Validator::make(			
				Input::All(),
				$d->validrules(),
				$d->validationmssg()
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

			$e=new Produtofatura;	
			$e->convenio_id		=$convenio_id;

			// $succes variable contains array name=>value
			//from the form required in this controller
			foreach ($success as $key => $value) {
				//
				//Skipping 'products' value
				if ($key!='products') {
					$e->$key = $value;
				}
			}

			//$e->dthr_cadastro	=date('Y-m-d H:i:s');
			$e->sessao_id		=$fake->sessao_id();
			//$e->sessao_id	=$this->id_sessao;
			$e->save();

			$success['id']=$e->id;

			$produtocompra_array=explode(',', $success['products']);

			foreach ($produtocompra_array as $key => $value) {
				$value=explode(':', $value);
				if ($value[1]>0) {
					$p_compra=new Produtocompra;
					$p_compra->produtofatura_id =$success['id'];
					$p_compra->produto_id 		=$value[0];
					$p_compra->amount 			=$value[1];
					$p_compra->session_id 		=$fake->sessao_id();
					//$p_compra->sessao_id		=$this->id_sessao;
					$p_compra->save();
				}
					
			}

			$res = $d->responsedata(
				'produtofatura',
				true,
				'store',
				$success
				)
			;
			$code=200;
		}
		catch (Exception $e){
			SysAdminHelper::NotifyError($e->getMessage());
			$res = $d->responsedata(
				'contabancaria',
				false,
				'store',
				$validator->messages()
				)
			;
			$code=400;
		}
		return Response::json($res,$code);

	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($empresa_id,$convenio_id,$id)
	{
		$d=new EmpresaConvenioProdutofaturaData;
		return $d->show($id);
	}

	public function showvisible($empresa_id,$convenio_id,$id)
	{
		$d=new EmpresaConvenioProdutofaturaData;

		try {
			if (Produtofatura::whereId($id)->count()==0) {
				$res=$d->responsedata(
					'produtofatura',
					false,
					'show',
					$d->noexist
					)
				;
				$res=json_encode($res);
				throw new Exception($res);
			}

			$produtofatura=$d->show($id);
			$header=$d->header();
			return 
			View::make('tempviews.EmpresaConvenioProdutofatura.show',
				compact(
					'produtofatura',
					'header',
					'empresa_id',
					'convenio_id',
					'id'
					)
				)
			;
			
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($empresa_id,$convenio_id,$id)
	{
		$d=new EmpresaConvenioProdutofaturaData;
		try {
			if (Produtofatura::whereId($id)->count()==0) {
				$res=$d->responsedata(
					'contabancaria',
					false,
					'edit',
					$d->noexist
					)
				;
				$res=json_encode($res);
				throw new Exception($res);
			}
			
			$produtofatura=$d->show($id);
			$header=$d->header();
			return View::make(
				'tempviews.EmpresaConvenioProdutofatura.edit',
				compact(
					'produtofatura',
					'header',
					'empresa_id',
					'convenio_id',
					'id'
					)
				)
			;
			
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($empresa_id,$convenio_id,$id)
	{
		//instantiate fake user (for empresa and sessao)
		//SHOULD BE DELETED IN ORIGINAL PROJECT
		$fake=new fakeuser;

		$d=new EmpresaConvenioProdutofaturaData;

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

			//upgrade produtocompra
			//1. Removing all items
			Produtocompra::whereProdutofatura_id($id)->delete();
			
			//2. Converting produto:quantity data into a php array
			$preitems=explode(',', $success['products']);
			$item=array();
			foreach ($preitems as $i) {
				$i=explode(':', $i);
				$item[$i[0] ] = $i[1] ;
			}
			
			//3. Creating new produtocompra records
			foreach ($item as $k => $v) {
				if ($v>0) {
					$p_c=new Produtocompra;
					$p_c->produtofatura_id 	=$id;
					$p_c->produto_id 		=$k;
					$p_c->amount 			=$v;
					$p_c->session_id 		=$fake->sessao_id();
					//$p_c->sessao_id		=$this->id_sessao;
					$p_c->save();
				}
			}

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
	public function destroy($empresa_id,$convenio_id,$id)
	{
		//
	}


}
