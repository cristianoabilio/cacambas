<?php
class EmpresaLoginAnotacoesData extends StandardResponse{
	//
	/** 
	* function name: header.
	* @param header with headers of table
	*/
	public function header(){
		$header=array(
			array('anotacoe',1)
			,array('status',0)
			)
		;
		return $header;
	}

	/**
	* @param edata retrieves all data from table anotacoes
	*/
	public function edata ($login) {
		return Login::find($login)->anotacoe;
	}

	public function show($id){
		return Anotacoe::find($id);
	}

	public function form_data(){
		$fillable=array('anotacoe');

		$nullable=array();

		/**
		* formCapture method converts fillable items in
		* array 'item_1' => Input::get('item_1'),
		*       'item_n' => Input::get('item_n') 
		* and if Input::get('nullable') is not empty
		* nullable items are added inside the array
		*
		* @return array
		*/
		return $this->formCapture($fillable,$nullable);
	}

	public function validrules(){
		return array(
			'anotacoe'=>'required'
			)
		;
	}

}

class EmpresaLoginAnotacoesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($empresa_id,$login_id)
	{
		$d=new EmpresaLoginAnotacoesData;
		return $d->edata ($login_id);
	}

	public function visible($empresa_id,$login_id)
	{
		$d=new EmpresaLoginAnotacoesData;
		$anotacoes=$d->edata($login_id);
		$header=$d->header();
		return View::make(
			'tempviews.EmpresaLoginAnotacoes.index',
			compact(
				'empresa_id',
				'login_id',
				'anotacoes',
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
	public function create($empresa_id,$login_id)
	{
		return View::make('tempviews.EmpresaLoginAnotacoes.create',
			compact(
				'empresa_id',
				'login_id'
				)
			)
		;
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($empresa_id,$login_id)
	{
		$d=new EmpresaLoginAnotacoesData;
		$success=$d->form_data();
		$fake=new fakeuser;

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
				$datamssg=$validator->messages();
				throw new Exception(
					json_encode(
						array(
							'validation_errors'=>$validator->messages()->all()
							)
						)
					)
				;
			}

			$e=new Anotacoe;
			$e->login_id= $login_id;
			foreach ($success as $key => $value) {
				$e->$key 	=$value;
			}
			$e->status=1;
			$e->sessao_id=$fake->sessao_id();

			$e->save();

			$success['id']=$e->id;

			$res=$d->responsedata(
				'anotacoe',
				true,
				'store',
				$success
				)
			;
			$code=200;
		}
		catch (Exception $e){
			if (!isset($datamssg)) {
				$datamssg=$e->getMessage();
			}
			else if ($datamssg!=$validator->messages()) {
				$datamssg=$e->getMessage();
			}
			SysAdminHelper::NotifyError($e->getMessage());
			$res=$d->responsedata(
				'anotacoe',
				false,
				'store',
				$datamssg
				//$e->getMessage()
				//$validator->messages()
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
	public function show($empresa_id,$login_id,$id)
	{
		$d=new EmpresaLoginAnotacoesData;
		return $d->show($id);
	}

	public function showvisible($empresa_id,$login_id,$id)
	{
		$d=new EmpresaLoginAnotacoesData;
		try {
			if (Anotacoe::whereId($id)->count()==0) {
				$res=$d->responsedata(
					'anotacoe',
					false,
					'show',
					$d->noexist
					)
				;
				$res=json_encode($res);
				throw new Exception($res);
			}
			$anotacoe=$d->show($id);
			$header=$d->header();
			
			return View::make(
				'tempviews.EmpresaLoginAnotacoes.show',
				compact(
					'anotacoe',
					'header',
					'empresa_id',
					'login_id',
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
	public function edit($empresa_id,$login_id,$id)
	{
		$d=new EmpresaLoginAnotacoesData;
		try {
			if (Anotacoe::whereId($id)->count()==0) {
				$res=$d->responsedata(
					'anotacoe',
					false,
					'edit',
					$d->noexist
					)
				;
				$res=json_encode($res);
				throw new Exception($res);
			}
			$anotacoe=$d->show($id);
			$header=$d->header();
			
			return View::make(
				'tempviews.EmpresaLoginAnotacoes.edit',
				compact(
					'anotacoe',
					'header',
					'empresa_id',
					'login_id',
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
	public function update($empresa_id,$login_id,$id)
	{
		$d=new EmpresaLoginAnotacoesData;
		$success=$d->form_data();
		$fake=new fakeuser;

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

			$e=Anotacoe::find($id);
			foreach ($success as $key => $value) {
				$e->$key 	=$value;
			}
			//
			$e->sessao_id		=$fake->sessao_id();
			//$e->sessao_id	=$this->id_sessao;
			$e->save();	

			//response structure required for angularjs
			$res=$d->responsedata(
				'anotacoe',
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
				'anotacoe',
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
	public function destroy($empresa_id,$login_id,$id)
	{
		//
	}


}
