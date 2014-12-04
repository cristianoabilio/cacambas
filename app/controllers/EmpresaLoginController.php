<?php
/**
 * [ControllerName]Data class only contains data related to
 * the table it represents 
 */
class EmpresaLoginData extends StandardResponse{
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
			,array('email',0)
			,array('login',1)
			,array('dthr_cadastro',0)
			,array('dthr_ultimoacesso',0)
			,array('remember_token',0)
		);	
		return $header;
	}
	
	/**
	* @param edata retrieves all data from table "empresa"
	*/
	public function edata ($empresa) {
		return Empresa::find($empresa)->login;
	}

	public function show($id){
		return Login::find($id);
	}

	/**
	* @param formdata returns array with form values
	*/
	public function form_data(){

		$formdata= array(
			'nome'		=>Input::get('nome')
			,'email'	=>Input::get('email')
			,'login'	=>Input::get('login')
			,'senha'	=>Hash::make(Input::get('senha'))
			)
		;

		$nullable=array(
			)
		;
		foreach ($nullable as $key => $value) {
			if ( trim($value)!="" ) {
				$formdata[$key]=$value;
			} else {
				$formdata[$key]=null;
			}
		}


		return $formdata;
	}

	public function validrules(){
		return array(
			'nome'=>	'required'
			//,'email'=>	'required'
			,'login'=>	'required'
			,'senha'=>	'required'

			// ,'dthr_cadastro'=> timestamp, not required
			// ,'sessao_id'=> sessao, not required
			)
		;
	}

}

class EmpresaLoginController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($empresa_id)
	{
		$d=new EmpresaLoginData;
		return Response::json($d->edata($empresa_id) );	
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
	public function visible ($empresa_id) {
		$d=new EmpresaLoginData;
		$data=array(
			//all login
			'login'=>$d->edata($empresa_id),
			'header'=>$d->header(),
			'empresa_id'=>$empresa_id,
			'nested'=>$d->empresalogin_nested()
			)
		;
		return View::make('tempviews.empresalogin.index',$data);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($empresa_id)
	{
		$data=compact('empresa_id');
		return View::make('tempviews.empresalogin.create',$data);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($empresa_id)
	{
		$d=new EmpresaLoginData;
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

			//check if username is already on use
			if (Login::whereLogin($success['login'])->count()>0) {
				$datamssg='';
				throw new Exception(
					 ('login name already on use')
					)
				;
			}

			//check if email is already on use
			if (Login::whereEmail($success['email'])->count()>0) {
				$datamssg='';
				throw new Exception(
					 ('Email already on use, choose a different one')
					)
				;
			}

			$e=new Login;	
			$e->empresa_id= $empresa_id;
			foreach ($success as $key => $value) {
				$e->$key 	=$value;
			}
			$e->status=1;

			//timestamp
			$e->dthr_cadastro	=date('Y-m-d H:i:s');

			$e->save();

			$success['id']=$e->id;

			$res=$d->responsedata(
				'login',
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
				'login',
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
	public function show($empresa_id,$id)
	{
		$d=new EmpresaLoginData;
		return $d->show($id);
	}

	public function showvisible($empresa_id,$id) {
		$d=new EmpresaLoginData;
		try {
			if (Login::whereId($id)->count()==0) {
				$res=$d->responsedata(
					'login',
					false,
					'show',
					$d->noexist
					)
				;
				$res=json_encode($res);
				throw new Exception($res);
			}
			$data=array(
				'login'	=>$d->show($id),
				'header'		=>$d->header(),
				'id'			=>$id,
				'empresa_id'	=>$empresa_id
				)
			;
			return View::make('tempviews.empresalogin.show',$data);
			
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
	public function edit($empresa_id,$id)
	{
		$d=new EmpresaLoginData;
		try {
			if (Login::whereId($id)->count()==0) {
				$res=$d->responsedata(
					'login',
					false,
					'edit',
					$d->noexist
					)
				;
				$res=json_encode($res);
				throw new Exception($res);
			}
			$data=array(
				'login'	=>$d->show($id),
				'header'		=>$d->header(),
				'id'			=>$id,
				'empresa_id'	=>$empresa_id
				)
			;
			return View::make('tempviews.empresalogin.edit',$data);
			
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
	public function update($empresa_id,$id)
	{
		//instantiate fake user (for empresa and sessao)
		//SHOULD BE DELETED IN ORIGINAL PROJECT
		$fake=new fakeuser;

		$d=new EmpresaLoginData;
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

			$e=Login::find($id);
			foreach ($success as $key => $value) {
				$e->$key 	=$value;
			}
			$e->status=1;

			$e->dthr_cadastro	=date('Y-m-d H:i:s');

			$e->save();	

			//response structure required for angularjs
			$res=$d->responsedata(
				'login ',
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
				'login ',
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
		$d=new EmpresaLoginData;
		try{
			if (Login::whereId($id)->count()==0) {
				throw new Exception(json_encode($d->noexist));
			}
			$e=Login::find($id);
			$e->status=0;
			$e->save();

			$res=$d->responsedata(
				'login',
				true,
				'delete',
				array('msg' => 'Registro excluído com sucesso!')
				)
			;
			$code=200;

		}catch(Exception $e){

			SysAdminHelper::NotifyError($e->getMessage());

			$res=$d->responsedata(
				'login',
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
