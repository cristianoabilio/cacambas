<?php

/**
 * FuncionarioData class only contains data related to
 * the table Funcionario 
 */
class FuncionarioData extends StandardResponse{
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
			array('empresa_id',0)
			,array('login_id',0)
			,array('nome',1)
			,array('funcao',1)
			,array('telefone',0)
			,array('status',1)
		);	
		return $header;
	}
	
	/**
	* @param edata retrieves all data from table "empresa"
	*/
	/*public function edata ($empresa) {
		return Empresa::find($empresa)->Funcionario;
	}*/
	public function edata () {
		return Funcionario::all();
	}

	public function show($id){
		return Funcionario::find($id);
	}

	/**
	* @param formdata returns array with form values
	*/
	public function form_data(){

		$formdata= array(
			'nome'		=>Input::get('nome'),
			'funcao'	=>Input::get('funcao'),
			'telefone'	=>Input::get('telefone')
			)
		;

		$nullable=array(
			'login_id'	=>Input::get('login_id')
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
			'nome'		=>	'required'
			,'funcao'	=>	'required'
			,'telefone'	=>	'required'
			// ,'dthr_cadastro'=> timestamp, not required
			// ,'sessao_id'=> sessao, not required
			)
		;
	}

}


class FuncionarioController extends \BaseController {

	public function __construct(){
		$this->beforeFilter('csrf', array('on' => 'post'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index () {
		$d=new FuncionarioData;
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
		$d=new FuncionarioData;
		$data=array(
			//all funcionario
			'funcionario'=>$d->edata(),
			'header'=>$d->header()
			)
		;
		return View::make('tempviews.funcionario.index',$data);

	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$data=array();
		return View::make('tempviews.funcionario.create',$data);

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

		$d=new FuncionarioData;
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

			$e=new Funcionario;	
			$e->empresa_id= $fake->empresa();
			foreach ($success as $key => $value) {
				$e->$key 	=$value;
			}
			$e->status=1;

			$e->sessao_id		=$fake->sessao_id();
			//$e->sessao_id		=$this->id_sessao;

			//timestamp
			$e->dthr_cadastro	=date('Y-m-d H:i:s');

			$e->save();

			$success['id']=$e->id;

			$res=$d->responsedata(
				'funcionario',
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
				'funcionario',
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
	public function show ($id) {
		$d=new FuncionarioData;
		return $d->show($id);
	}
	//
	public function showvisible($id)
	{
		$d=new FuncionarioData;
		try {
			if (Funcionario::whereId($id)->count()==0) {
				$res=$d->responsedata(
					'funcionario',
					false,
					'show',
					$d->noexist
					)
				;
				$res=json_encode($res);
				throw new Exception($res);
			}
			$data=array(
				'funcionario'	=>$d->show($id),
				'header'		=>$d->header(),
				'id'			=>$id
				)
			;
			return View::make('tempviews.funcionario.show',$data);
			
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
		$d=new FuncionarioData;
		try {
			if (Funcionario::whereId($id)->count()==0) {
				$res=$d->responsedata(
					'funcionario',
					false,
					'edit',
					$d->noexist
					)
				;
				$res=json_encode($res);
				throw new Exception($res);
			}
			$data=array(
				'funcionario'	=>$d->show($id),
				'header'		=>$d->header(),
				'id'			=>$id
				)
			;
			return View::make('tempviews.funcionario.edit',$data);
			
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

		$d=new FuncionarioData;
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

			$e=Funcionario::find($id);
			foreach ($success as $key => $value) {
				$e->$key 	=$value;
			}
			$e->status=1;

			$e->dthr_cadastro	=date('Y-m-d H:i:s');
			$e->sessao_id		=$fake->sessao_id();
			//$e->sessao_id	=$this->id_sessao;
			$e->save();	

			//response structure required for angularjs
			$res=$d->responsedata(
				'funcionario ',
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
				'funcionario ',
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
		$d=new FuncionarioData;
		try{
			if (Funcionario::whereId($id)->count()==0) {
				throw new Exception(json_encode($d->noexist));
			}
			$e=Funcionario::find($id);
			$e->status=0;
			$e->save();

			$res=$d->responsedata(
				'funcionario',
				true,
				'delete',
				array('msg' => 'Registro excluído com sucesso!')
				)
			;
			$code=200;

		}catch(Exception $e){

			SysAdminHelper::NotifyError($e->getMessage());

			$res=$d->responsedata(
				'funcionario',
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
