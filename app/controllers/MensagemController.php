<?php
class MensagemData extends StandardResponse {
	/** 
	* function name: header.
	* @param header with headers of mensagem table
	*/
	public function header(){
		/*
		$header= headers on table empresas
		In order to display or hide on HTML table, set as
		1 (visible) or 2 (not shown)
		*/
		$header=array(
			array('login_id',1)
			,array('conversa_grupo_id',1)
			,array('texto',1)
			,array('status',1)
			)
		;			
		return $header;
	}

	/**
	* @param edata retrieves all data from table "equipamento"
	*/
	public function edata () {
		return Mensagem::all();
	}

	public function show($id){
		return Mensagem::find($id);
	}

	/**
	* @param formdata returns array with form values
	*/
	//
	public function form_data(){
		$fillable = array(			
			'login_id'
			,'conversa_id'
			,'conversa_grupo_id'
			,'texto'
			,'status'
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
			'login_id'				=> 'required|integer'
			,'conversa_id'			=> 'integer'
			,'conversa_grupo_id'	=> 'integer'			
			,'texto'				=> 'required'
			,'status'				=> 'required|integer'
			)
		;
	}
}

class MensagemController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$d= new MensagemData();
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

		$d=new MensagemData();
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

			$e=new Mensagem();	
			foreach ($success as $key => $value) {
				$e->$key 	=$value;
			}
			$e->save();

			$success['id']=$e->id;

			$res=$d->responsedata(
				'mensagem',
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
				'mensagem',
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
		$d = new MensagemData();
		return Response::json($d->show($id));
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
