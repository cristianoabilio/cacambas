<?php

class EmpresaClienteAnotacoesData extends StandardResponse{


	public function header () {
		return array(
			array('empresa_id',1)
			,array('cliente_id',1)
			,array('anotacao',1)
			,array('status',1)
			)
		;
	}

	public function edata () {
		return EmpresaClienteAnotacoes::whereStatus(1)->get();
	}

	public function edatadeleted () {
		return EmpresaClienteAnotacoes::whereStatus(0)->get();
	}

	public function show($id){
		return EmpresaClienteAnotacoes::find($id);
	}

	public function form_data(){
		$fillable=array(
			'empresa_id'		
			,'cliente_id'		
			,'anotacao'
			)
		;
		$nullable=array(
			//'status'		
			)
		;

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
			'empresa_id'	=>	'required'
			,'cliente_id'	=>	'required'
			,'anotacao'		=>	'required'
			)
		;
	}

	#
}

class EmpresaClienteAnotacoesDeprecatedController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$d=new EmpresaClienteAnotacoesData;
		return $d->edata();
	}

	public function visible()
	{
		$d=new EmpresaClienteAnotacoesData;
		$data=array(
			//all classe
			'empresaClienteAnotacoes'=>$d->edata(),
			'header'=>$d->header(),
			'deleted'=>$d->edatadeleted()
			)
		;
		return View::make('tempviews.EmpresaClienteAnotacoes.index',$data);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$d=new EmpresaClienteAnotacoesData;
		return View::make('tempviews.EmpresaClienteAnotacoes.create');
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

		$d=new EmpresaClienteAnotacoesData;

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

			$e=new EmpresaClienteAnotacoes;	
			foreach ($success as $key => $value) {
				$e->$key 	=$value;
			}
			$e->status=1;
			$e->dthr_cadastro=date('Y-m-d');

			$e->sessao_id		=$fake->sessao_id();
			//$e->sessao_id		=$this->id_sessao;
			$e->save();

			$success['id']=$e->id;

			$res=$d->responsedata(
				'empresaclienteanotacoes',
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
				'empresaclienteanotacoes',
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
		$d=new EmpresaClienteAnotacoesData;
		return $d->show($id);
	}

	public function showvisible($id)
	{
		$d=new EmpresaClienteAnotacoesData;
		$header=$d->header();
		$EmpresaClienteAnotacoes=$d->show($id);
		return View::make(
			'tempviews.EmpresaClienteAnotacoes.show',
			compact(
				'header',
				'EmpresaClienteAnotacoes',
				'id'
				)
			)
		;
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$d=new EmpresaClienteAnotacoesData;
		$header=$d->header();
		$EmpresaClienteAnotacoes=$d->show($id);
		return View::make(
			'tempviews.EmpresaClienteAnotacoes.edit',
			compact(
				'header',
				'EmpresaClienteAnotacoes',
				'id'
				)
			)
		;
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

		$d=new EmpresaClienteAnotacoesData;

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

			$e=EmpresaClienteAnotacoes::find($id);
			foreach ($success as $key => $value) {
				$e->$key 	=$value;
			}
			//$e->status=1;
			$e->dthr_cadastro=date('Y-m-d');

			$e->sessao_id		=$fake->sessao_id();
			//$e->sessao_id		=$this->id_sessao;
			$e->save();

			//$success['id']=$e->id;

			$res=$d->responsedata(
				'empresaclienteanotacoes',
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
				'empresaclienteanotacoes',
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
		$d=new EmpresaClienteAnotacoesData;
		try{
			if (EmpresaClienteAnotacoes::whereId($id)->count()==0) {
				throw new Exception(json_encode($d->noexist));
				$code=400;
			}

			$c=EmpresaClienteAnotacoes::find($id);
			$c->status=0;
			$c->save();
			//::whereId($id)->delete();
			$res=$d->responsedata(
				'empresaclienteanotacoes',
				true,
				'delete',
				array('msg' => 'Registro excluído com sucesso!')
				)
			;
			$code=200;

		}
		catch(Exception $e){
			SysAdminHelper::NotifyError($e->getMessage());
			$res=$d->responsedata(
				'empresaclienteanotacoes',
				false,
				'delete',
				array('msg' => json_decode($e->getMessage()))
				)
			;
			$code=400;
		}
		return Response::json($res,$code);
	}


	public function reactivate ($id) {
		$d=new EmpresaClienteAnotacoesData;
		try{
			if (EmpresaClienteAnotacoes::whereId($id)->count()==0) {
				throw new Exception(json_encode($d->noexist));
				$code=400;
			}

			$c=EmpresaClienteAnotacoes::find($id);
			$c->status=1;
			$c->save();
			//::whereId($id)->delete();
			$res=$d->responsedata(
				'empresaclienteanotacoes',
				true,
				'restore',
				array('msg' => 'Resource successfully restored!')
				)
			;
			$code=200;

		}
		catch(Exception $e){
			SysAdminHelper::NotifyError($e->getMessage());
			$res=$d->responsedata(
				'empresaclienteanotacoes',
				false,
				'restore',
				array('msg' => json_decode($e->getMessage()))
				)
			;
			$code=400;
		}
		return Response::json($res,$code);
	}


}
