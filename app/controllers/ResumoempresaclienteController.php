<?php

/**
 *  class only contains data related to
 * the table Compras
 */
class ResumoempresaclienteData extends StandardResponse{
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
			array('cliente_id',1)
			,array('data',0)
			,array('total_locacoes',0)
			,array('total_aberto',0)
			,array('total_recebido',0)
			,array('total_atrasado',0)
		);	
		return $header;
	}
	
	/**
	* @param edata retrieves all data from table "Resumoempresacliente"
	*/
	public function edata () {
		return Resumoempresacliente::all();
	}

	public function show($id){
		return Resumoempresacliente::find($id);
	}

	/**
	* @param formdata returns array with form values
	*/
	public function form_data(){

		return array(
			'cliente_id'		=>Input::get('cliente_id'),
			'data'				=>Input::get('data'),
			'total_locacoes'	=>Input::get('total_locacoes'),
			'total_aberto'		=>Input::get('total_aberto'),
			'total_recebido'	=>Input::get('total_recebido'),
			'total_atrasado'	=>Input::get('total_atrasado')
			)
		;
	}

	public function validrules(){
		return array(
			'cliente_id'		=>	'required'
			,'data'				=>	'required'
			,'ano_referencia'	=>	'required'
			,'total_locacoes'	=>	'required'
			,'total_aberto'		=>	'required'
			,'total_recebido'	=>	'required'
			,'total_atrasado'	=>	'required'
			
			)
		;
	}

}

class ResumoempresaclienteController extends \BaseController {

	public function __construct(){
		//$this->beforeFilter('csrf', array('on' => 'post'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index () {
		$d=new ResumoempresaclienteData;
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
		
		$d=new ResumoempresaclienteData;
		$data=array(
			//all compras
			'resumoempresacliente'=>$d->edata(),
			'header'=>$d->header()
			)
		;
		return View::make('tempviews.ResumoEmpresaCliente.index',$data);

	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('tempviews.ResumoEmpresaCliente.create');

	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//DEPRECATED AS STORE ACTION IS NESTED WITHIN EMPRESA!!!
		/*//instantiate fake user (for empresa and sessao)
		//SHOULD BE DELETED IN ORIGINAL PROJECT
		$fake=new fakeuser;
		//

		$d=new ResumoempresaclienteData;
		$success=$d->form_data();

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

			$e=new Resumoempresacliente;
			$e->empresa_id = $fake->empresa();	
			foreach ($success as $key => $value) {
				$e->$key 	=$value;
			}
			$e->save();

			$success['id']=$e->id;

			$res=$d->responsedata(
				'resumoempresacliente',
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
				'resumoempresacliente',
				false,
				'store',
				$validator->messages()
				)
			;
			$code=400;
		}
		return Response::json($res,$code);*/
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */

	public function show ($id) {
		$d=new ResumoempresaclienteData;
		return $d->show($id);
	}

	//
	public function showvisible($id)
	{
		$d=new ResumoempresaclienteData;
		try {
			if (Resumoempresacliente::whereId($id)->count()==0) {
				$res=$d->responsedata(
					'resumoempresacliente',
					false,
					'show',
					$d->noexist
					)
				;
				$res=json_encode($res);
				throw new Exception($res);
			}
			$data=array(
				'resumoempresacliente'	=>$d->show($id),
				'header'				=>$d->header(),
				'id'					=>$id
				)
			;
			return View::make('tempviews.ResumoEmpresaCliente.show',$data);
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
	public function edit($id)
	{
		$d=new ResumoempresaclienteData;
		try {
			if (Resumoempresacliente::whereId($id)->count()==0) {
				$res=$d->responsedata(
					'resumoempresacliente',
					false,
					'edit',
					$d->noexist
					)
				;
				$res=json_encode($res);
				throw new Exception($res);
			}
			$data=array(
				'resumoempresacliente'	=>$d->show($id),
				'header'				=>$d->header(),
				'id'					=>$id
				)
			;
			return View::make('tempviews.ResumoEmpresaCliente.edit',$data);

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
	public function update($id)
	{
		//instantiate fake user (for empresa and sessao)
		//SHOULD BE DELETED IN ORIGINAL PROJECT
		$fake=new fakeuser;

		$d=new ResumoempresaclienteData;
		$success=$d->form_data();

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

			$e=Resumoempresacliente::find($id);
			foreach ($success as $key => $value) {
				$e->$key 	=$value;
			}
			$e->save();	

			//response structure required for angularjs
			$res=$d->responsedata(
				'resumoempresacliente',
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
				'resumoempresacliente',
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
	// public function destroy($id)
	// {
	// 	//
	// }


}
