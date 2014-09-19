<?php

/**
 * empresaheader class only contains data related to
 * the table Empresa
 */
class contabancariaheader{
	/** 
	* function name: header.
	* @param header with headers of contabancaria table
	*/
	public function header(){
		/*
		$contabancariaheader= headers on table contabancarias
		In order to display or hide on HTML table, set as
		1 (visible) or 2 (not shown)
		*/
		$contabancariaheader=array(	
			array('IDEmpresa',0)
			,array('nome_banco',1)
			,array('codigo_banco',1)
			,array('conta',1)
			,array('conta_dig',1)
			,array('conta_tipo',0)
			,array('agencia',0)
			,array('agencia_dig',0)
			,array('cpf_cnpj',0)
			,array('pj',0)
			,array('titular',0)
			,array('dthr_cadastro',0)
			,array('IDSessao',0)
			)
		;	
		return $contabancariaheader;
	}
	
	/**
	* @param edata retrieves all data from table "empresa"
	*/
	public function edata () {
		return 
		Contabancaria::all();
	}

	public function show($id){
		return 
		Contabancaria::where('IDConta','=',$id)
		->first();
	}
}

class ContabancariaController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$d=new contabancariaheader;
		$data=array(
			'conta'=>$d->edata(),
			'header'=>$d->header()
			)
		;
		return 
		View::make('tempviews.contabancaria.index',
			$data);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return
		View::make(
			'tempviews.contabancaria.create'
			)
		;
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		try{
			$validator= Validator::make(			
				Input::All(),	
				array(		
					'IDEmpresa'			=>	'required'
					,'nome_banco'		=>	'required'
					,'codigo_banco'		=>	'required'
					,'conta'			=>	'required'
					,'conta_dig'		=>	'required'
					,'conta_tipo'		=>	'required'
					,'agencia'			=>	'required'
					,'agencia_dig'		=>	'required'
					,'cpf_cnpj'			=>	'required'
					,'pj'				=>	'required'
					,'titular'			=>	'required'
					,'IDSessao'			=>	'required'
					),
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

			$e=new Contabancaria;	
			$e->IDEmpresa	=Input::get('IDEmpresa');
			$e->nome_banco	=Input::get('nome_banco');
			$e->codigo_banco	=Input::get('codigo_banco');
			$e->conta	=Input::get('conta');
			$e->conta_dig	=Input::get('conta_dig');
			$e->conta_tipo	=Input::get('conta_tipo');
			$e->agencia	=Input::get('agencia');
			$e->agencia_dig	=Input::get('agencia_dig');
			$e->cpf_cnpj	=Input::get('cpf_cnpj');
			$e->pj	=Input::get('pj');
			$e->titular	=Input::get('titular');
			$e->dthr_cadastro	=date('Y-m-d H:i:s');
			$e->IDSessao	=Input::get('IDSessao');
			$e->save();	

			$res=$res = array(
				'status'=>'success',
				'msg' => 'SUCCESFULLY SAVED!'
				)
			;
		}
		catch (Exception $e){
			SysAdminHelper::NotifyError($e->getMessage());
			$res = array('status'=>'error','msg' => json_decode($e->getMessage()));
		}
		return Response::json($res);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$d=new contabancariaheader;
		$data=array(
			'conta'=>$d->show($id),
			'header'=>$d->header(),
			'id'=> $id
			)
		;
		return 
		View::make('tempviews.contabancaria.show',
			$data);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$d=new contabancariaheader;
		$data=array(
			'conta'=>$d->show($id),
			'header'=>$d->header(),
			'id'=> $id
			)
		;
		return View::make('tempviews.contabancaria.edit',$data);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		try{
			$validator= Validator::make(			
				Input::All(),	
				array(		
					'IDEmpresa'			=>	'required'
					,'nome_banco'		=>	'required'
					,'codigo_banco'		=>	'required'
					,'conta'			=>	'required'
					,'conta_dig'		=>	'required'
					,'conta_tipo'		=>	'required'
					,'agencia'			=>	'required'
					,'agencia_dig'		=>	'required'
					,'cpf_cnpj'			=>	'required'
					,'pj'				=>	'required'
					,'titular'			=>	'required'
					,'IDSessao'			=>	'required'
					),	
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

			$e=Contabancaria::find($id);
			$e->IDEmpresa	=Input::get('IDEmpresa');
			$e->nome_banco	=Input::get('nome_banco');
			$e->codigo_banco	=Input::get('codigo_banco');
			$e->conta	=Input::get('conta');
			$e->conta_dig	=Input::get('conta_dig');
			$e->conta_tipo	=Input::get('conta_tipo');
			$e->agencia	=Input::get('agencia');
			$e->agencia_dig	=Input::get('agencia_dig');
			$e->cpf_cnpj	=Input::get('cpf_cnpj');
			$e->pj	=Input::get('pj');
			$e->titular	=Input::get('titular');
			$e->dthr_cadastro	=date('Y-m-d H:i:s');
			$e->IDSessao	=Input::get('IDSessao');
			$e->save();

			$res=$res = array(
				'status'=>'success',
				'msg' => 'SUCCESFULLY UPDATED!'
				)
			;
		}
		catch (Exception $e){
			SysAdminHelper::NotifyError($e->getMessage());
			$res = array('status'=>'error','msg' => json_decode($e->getMessage()));
		}
		return Response::json($res);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		try{

			Contabancaria::where('IDConta','=',$id)
			->delete();	

			$res = array('status'=>'success','msg' => 'Registro excluído com sucesso!');

		}catch(Exception $e){

			SysAdminHelper::NotifyError($e->getMessage());

			$res = array('status'=>'error','msg' => json_decode($e->getMessage()));

		}

		return Response::json($res);
	}
}
