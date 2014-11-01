<?php

class EstadoCidadeData extends StandardResponse{
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
			array('nome',1)
			,array('capital',1)
		);	
		return $header;
	}
	
	/**
	* @param edata retrieves all data from table "empresa"
	*/
	public function edata ($estado_id) {
		return Estado::find($estado_id)->cidade;
	}

	public function show($id){
		return Cidade::find($id);
	}

	/**
	* @param formdata returns array with form values
	*/
	public function formatdata(){

		return array(
				'nome'			=>Input::get('nome'),
				'capital'		=>Input::get('capital')
				)
		;
	}

	public function validrules(){
		return array(
			'nome'		=>	'required'
			//,'capital'	=>	'required'
			)
		;
	}

}

class EstadoCidadeController extends \BaseController {

	public function __construct(){
		$this->beforeFilter('csrf', array('on' => 'post'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($estado_id)
	{
		$d=new EstadoCidadeData;
		return Response::json($d->edata($estado_id));
	}

	public function visible ($estado_id) {
		$d=new EstadoCidadeData;
		$cidade=$d->edata($estado_id);
		$header=$d->header();
		//
		return View::make(
			'tempviews.EstadoCidade.index',
			compact(
				'estado_id',
				'cidade',
				'header'
				)
			)
		;
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($estado_id)
	{
		return View::make('tempviews.EstadoCidade.create',
			compact(
				'estado_id'
				)
			)
		;
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($estado_id)
	{
		//instantiate fake user (for empresa and sessao)
		//SHOULD BE DELETED IN ORIGINAL PROJECT
		$fake=new fakeuser;
		//

		$d=new EstadoCidadeData;
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

			$e=new Cidade;	
			foreach ($success as $key => $value) {
				$e->$key 	=$value;
			}
			$e->estado_id=$estado_id;
			$e->save();

			$success['estado_id']=$estado_id;
			$success['id']=$e->id;

			$res=$d->responsedata(
				'cidade',
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
				'cidade',
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
	public function show($estado_id,$id)
	{
		$d=new EstadoCidadeData;
		return $d->show($id);
	}

	public function showvisible($estado_id,$id)
	{
		$d=new EstadoCidadeData;
		try {
			if (Cidade::whereId($id)->count()==0) {
				$res=$d->responsedata(
					'cidade',
					false,
					'show',
					$d->noexist
					)
				;
				$res=json_encode($res);
				throw new Exception($res);
			}
			$cidade=$d->show($id);
			$header=$d->header();
			
			return View::make('tempviews.EstadoCidade.show',
				compact(
					'cidade',
					'header',
					'estado_id',
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
	public function edit($estado_id,$id)
	{
		$d=new EstadoCidadeData;
		try {
			if (Cidade::whereId($id)->count()==0) {
				$res=$d->responsedata(
					'cidade',
					false,
					'edit',
					$d->noexist
					)
				;
				$res=json_encode($res);
				throw new Exception($res);
			}
			$cidade=$d->show($id);
			$header=$d->header();
			//
			return View::make('tempviews.EstadoCidade.edit',
				compact(
					'cidade',
					'header',
					'estado_id',
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
	public function update($estado_id,$id)
	{
		//instantiate fake user (for empresa and sessao)
		//SHOULD BE DELETED IN ORIGINAL PROJECT
		$fake=new fakeuser;

		$d=new EstadoCidadeData;
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

			$e=Cidade::find($id);
			foreach ($success as $key => $value) {
				$e->$key 	=$value;
			}
			$e->save();	

			//response structure required for angularjs
			$res=$d->responsedata(
				'cidade',
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
				'cidade',
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
	public function destroy($estado_id,$id)
	{
		//
	}


}
