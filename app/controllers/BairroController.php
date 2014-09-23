<?php

/**
 * [Table]Data class only contains data related to
 * the table 
 */
class BairroData extends StandardResponse{
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
			array('cidade_id',1)
			,array('estado_id',1)
			,array('zona',1)
			,array('nome',1)
		);	
		return $header;
	}
	
	/**
	* @param edata retrieves all data from table "empresa"
	*/
	public function edata () {
		return Bairro::all();
	}

	public function show($id){
		return Bairro::find($id);
	}

	/**
	* @param formdata returns array with form values
	*/
	public function formatdata(){

		return array(
				'cidade_id'			=>Input::get('cidade_id'),
				'estado_id'			=>Input::get('estado_id'),
				'zona'				=>Input::get('zona'),
				'nome'				=>Input::get('nome')
				)
		;
	}

	public function validrules(){
		return array(
			'cidade_id'		=>	'required|integer'
			,'estado_id'	=>	'required|integer'
			//,'zona'		=>	'required'
			,'nome'		=>	'required'
			)
		;
	}

}

class BairroController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$d=new BairroData;
		$data=array(
			//all bairro
			'bairro'=>$d->edata(),
			'header'=>$d->header()
			)
		;
		return View::make('tempviews.bairro.index',$data);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$data=array();
		return View::make('tempviews.bairro.create',$data);
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

		$d=new BairroData;
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

			$e=new Bairro;	
			foreach ($success as $key => $value) {
				$e->$key 	=$value;
			}
			$e->save();

			$res=$d->responsedata(
				'bairro',
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
				'bairro',
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
		$d=new BairroData;
		$data=array(
			'bairro'	=>$d->show($id),
			'header'	=>$d->header(),
			'id'		=>$id
			)
		;
		return View::make('tempviews.bairro.show',$data);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$d=new BairroData;
		$data=array(
			'bairro'	=>$d->show($id),
			'header'	=>$d->header(),
			'id'		=>$id
			)
		;
		return View::make('tempviews.bairro.edit',$data);
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

		$d=new BairroData;
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

			$e=Bairro::find($id);
			foreach ($success as $key => $value) {
				$e->$key 	=$value;
			}
			$e->save();	

			//response structure required for angularjs
			$res=$d->responsedata(
				'bairro',
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
				'bairro',
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