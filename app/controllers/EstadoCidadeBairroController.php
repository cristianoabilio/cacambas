<?php

/**
 * [Table]Data class only contains data related to
 * the table 
 */
class EstadoCidadeBairroData extends StandardResponse{


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
			array('zona',1)
			,array('nome',1)
		);	
		return $header;
	}
	
	/**
	* @param edata retrieves all data from table "empresa"
	*/
	public function edata ($cidade_id) {
		
		return $exist= Cidade::find($cidade_id)->bairro;
	}

	public function show($estado_id,$cidade_id,$id){
		return Bairro::find($id);
	}

	/**
	* @param formdata returns array with form values
	*/
	public function form_data(){

		return array(
				'zona'				=>Input::get('zona'),
				'nome'				=>Input::get('nome')
				)
		;
	}

	public function validrules(){
		return array(
			//,'zona'		=>	'required'
			'nome'		=>	'required'
			)
		;
	}
}

class EstadoCidadeBairroController extends \BaseController {
	public function __construct()  {
		$this->beforeFilter('csrf', array('on' => 'post'));
		$this->beforeFilter('geoendereco');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index ($estado_id,$cidade_id) {
		//For unknown reason 'checkestadocidadebairro'
		//filter is not working here.
		//Next code is a pseudofilter.
		$d=new EstadoCidadeBairroData;
		return $d->edata($cidade_id);
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
	public function visible($estado_id,$cidade_id)
	{
		$d=new EstadoCidadeBairroData;
		$bairro=$d->edata($cidade_id);
		$header=$d->header();
		$cidade=Cidade::find($cidade_id);

		return View::make(
			'tempviews.EstadoCidadeBairro.index',
			compact(
				'bairro',
				'header',
				'estado_id',
				'cidade_id',
				'cidade'
				)
			)
		;
			
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($estado_id,$cidade_id)
	{
		$cidade=Cidade::find($cidade_id);
		return View::make('tempviews.EstadoCidadeBairro.create',
			compact(
				'estado_id',
				'cidade_id',
				'cidade'
				)
			)
		;
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($estado_id,$cidade_id)
	{
		//instantiate fake user (for empresa and sessao)
		//SHOULD BE DELETED IN ORIGINAL PROJECT
		$fake=new fakeuser;
		//

		$d=new EstadoCidadeBairroData;
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

			$e=new Bairro;	
			foreach ($success as $key => $value) {
				$e->$key 	=$value;
			}
			$e->cidade_id=$cidade_id;
			$e->save();

			$success['id']=$e->id;
			$success['cidade_id']=$e->cidade_id;

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
	public function show ($estado_id,$cidade_id,$id) {
		$d=new EstadoCidadeBairroData;
		return $d->show($estado_id,$cidade_id,$id);
		
	}
	public function showvisible($estado_id,$cidade_id,$id)
	{
		$d=new EstadoCidadeBairroData;
		$show=$d->show($estado_id,$cidade_id,$id);

		try {
			if (Bairro::whereId($id)->count()==0) {
				$res=$d->responsedata(
					'bairro',
					false,
					'show',
					$d->noexist
					)
				;
				$res=json_encode($res);
				throw new Exception($res);
			}
			
			$bairro	=$show;
			$header	=$d->header();
			return View::make('tempviews.EstadoCidadeBairro.show',
				compact(
					'bairro',
					'header',
					'estado_id',
					'cidade_id',
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
	public function edit($estado_id,$cidade_id,$id)
	{
		$d=new EstadoCidadeBairroData;
		$edit=$d->show($estado_id,$cidade_id,$id);

		try {
			if (Bairro::whereId($id)->count()==0) {
				$res=$d->responsedata(
					'bairro',
					false,
					'edit',
					$d->noexist
					)
				;
				$res=json_encode($res);
				throw new Exception($res);
			}
			$bairro	=$edit;
			$header	=$d->header();
			return View::make('tempviews.EstadoCidadeBairro.edit',
				compact(
					'bairro',
					'header',
					'estado_id',
					'cidade_id',
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
	public function update($estado_id,$cidade_id,$id)
	{
		//instantiate fake user (for empresa and sessao)
		//SHOULD BE DELETED IN ORIGINAL PROJECT
		$fake=new fakeuser;

		$d=new EstadoCidadeBairroData;
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
	// public function destroy($estado_id,$cidade_id,$id)
	// {
	// 	//
	// }


}
