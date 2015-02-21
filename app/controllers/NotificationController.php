<?php
class NotificationData extends StandardResponse {
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
			array('type',1)
			,array('actor_id',1)
			,array('actor_type',1)
			,array('actor_name',1)
			,array('verb',1)
			,array('object_type',1)
			,array('object_id',1)
			,array('object_name',1)
			,array('target_type',1)
			,array('target_type',1)
			,array('target_id',1)
			,array('target_name',1)			
			,array('private',1)
			)
		;			
		return $header;
	}

	/**
	* @param edata retrieves all data from table "equipamento"
	*/
	public function edata () {
		return Notification::all();
	}

	public function show($id){
		return Notification::find($id);
	}

	/**
	* @param formdata returns array with form values
	*/
	//
	public function form_data(){
		$fillable = array(
			'type'
			,'actor_id'
			,'actor_type'
			,'actor_name'
			,'verb'
			,'object_type'
			,'object_id'
			,'object_name'
			,'target_type'
			,'target_type'
			,'target_id'
			,'target_name'
			,'private'
			)
		;

		$nullable = array();

		/**
		* formCapture method converts fillable items in
		* array 'item_1' => Input::get('item_1'),
		*       'item_n' => Input::get('item_n') 
		* and if Input::get('nullable') is not empty
		* nullable item is added inside the array
		* @return array
		*
		*/

		return $this->formCapture ($fillable,$nullable);

	}	
	
	
	
	public function validrules(){
		return array(
			'type'			=> 'required|integer'
			,'actor_id'		=> 'required|integer'
			,'actor_name'	=> 'required'
			,'actor_type'	=> 'required'
			,'verb'			=> 'required'
			,'object_type'	=> 'required'
			,'object_id'	=> 'required|integer'
			,'object_name'	=> 'required'
			,'target_type'	=> 'required'
			,'target_id'	=> 'required|integer'
			,'target_name'	=> 'required'
			,'private'		=> 'required'
			)
		;
	}
}


class NotificationController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$d=new NotificationData();
		return Response::json($d->edata());
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
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

		$d=new NotificationData();
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

			$e=new Notification();	
			foreach ($success as $key => $value) {
				$e->$key 	=$value;
			}
			$e->save();

			$success['id']=$e->id;

			$res=$d->responsedata(
				'notificacao',
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
				'notificacao',
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
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
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
