<?php

/**
 * comprasdata class only contains data related to
 * the table Compras
 */
class comprasdata extends StandardResponse{
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
		return Compras::find($id);
	}

	/**
	* @param formdata returns array with form values
	*/
	public function formatdata(){

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

	public function validrules(){
		return array(
			'produto_id'		=>	'required'
			,'convenio_id'		=>	'required'
			,'limite'			=>	'required'
			,'desconto_valor'	=>	'required'
			,'desconto_percentual'=>'required'
			,'ativado'			=>	'required'
			,'data_compra'		=>	'required'
			,'data_ativacao'	=>	'required'
			,'data_desativacao'	=>	'required'
			// ,'dthr_cadastro'=> timestamp, not required
			// ,'sessao_id'=> sessao, not required
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
		$d=new comprasdata;
		$data=array(
			//all compras
			'compras'=>$d->edata(),
			'header'=>$d->header()
			)
		;
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
		$fake=new fakeuser;
		//

		$d=new comprasdata;
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

			$e=new Compras;	
			foreach ($success as $key => $value) {
				$e->$key 	=$value;
			}

			//timestamp
			$e->dthr_cadastro	=date('Y-m-d H:i:s');

			$e->sessao_id		=$fake->sessao_id();
			//$e->sessao_id		=$this->id_sessao;
			
			$e->save();

			$res=$d->responsedata(
				'Compras',
				true,
				'store',
				$success
				)
			;
			$code=200;
		}
		catch (Exception $e){
			SysAdminHelper::NotifyError($e->getMessage());
			$res=$d->responsedata(
				'Compras',
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
	public function show($id)
	{
		$d=new comprasdata;
		$data=array(
			'compras'	=>$d->show($id),
			'header'	=>$d->header(),
			'id'		=>$id
			)
		;
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
		$d=new comprasdata;
		$data=array(
			'compras'	=>$d->show($id),
			'header'	=>$d->header(),
			'id'		=>$id
			)
		;
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
		$fake=new fakeuser;

		$d=new comprasdata;
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

			$e=Compras::find($id);
			foreach ($success as $key => $value) {
				$e->$key 	=$value;
			}

			$e->dthr_cadastro	=date('Y-m-d H:i:s');
			$e->sessao_id		=$fake->sessao_id();
			//$e->sessao_id	=$this->id_sessao;
			$e->save();	

			//response structure required for angularjs
			$res=$d->responsedata(
				'Compras',
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
				'Compras',
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
		$d=new comprasdata;
		try{

			$e=Compras::whereId($id)->delete();

			$res=$d->responsedata(
				'Compras',
				true,
				'delete',
				array('msg' => 'Registro excluído com sucesso!')
				)
			;
			$code=200;

		}catch(Exception $e){

			SysAdminHelper::NotifyError($e->getMessage());

			$res=$d->responsedata(
				'Compras',
				false,
				'delete',
				array('msg' => json_decode($e->getMessage()))
				)
			;
			$code=400;

		}

		return Response::json($res,$code);
	}


}
