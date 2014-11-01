<?php

/**
 * EnderecoempresaData class only contains data related to
 * the table Funcionario 
 */
class EnderecoempresaData extends StandardResponse{
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
			array('empresa_id',1)
			,array('endereco_id',1)
			,array('tipo',1)
			,array('complemento',1)
			,array('observacao',1)
			,array('status',1)
			,array('dthr_cadastro',0)
			,array('sessao_id',0)
		);	
		return $header;
	}
	
	/**
	* @param edata retrieves all data from table "empresa"
	*/
	/*public function edata ($empresa) {
		return Empresa::find($empresa)->Enderecoempresa;
	}*/
	public function edata () {
		return Enderecoempresa::all();
	}

	public function show($id){
		return Enderecoempresa::find($id);
	}

	/**
	* @param formdata returns array with form values
	*/
	public function formatdata(){

		$formatdata= array(
			'enderecobase_id'	=>	Input::get('enderecobase_id')
			,'endereco_id'		=>	Input::get('endereco_id')
			,'tipo'				=>	Input::get('tipo')
			,'status'			=>	Input::get('status')
			)
		;

		$nullable=array(
			'complemento'		=>	Input::get('complemento')
			,'observacao'		=>	Input::get('observacao')
			)
		;
		foreach ($nullable as $key => $value) {
			if ( trim($value)!="" ) {
				$formdata[$key]=$value;
			}
		}


		return $formatdata;
	}

	public function validrules(){
		return array(
			'tipo'=>	'required'
			)
		;
	}

}



class EnderecoempresaController extends \BaseController {

	public function __construct(){
		$this->beforeFilter('csrf', array('on' => 'post'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$d=new EnderecoempresaData;
		return $d->edata();
	}

	public function visible () {
		$d=new EnderecoempresaData;
		$data=array(
			'enderecoempresa'	=>$d->edata(),
			'header'			=>$d->header()
			)
		;
		return View::make('tempviews.enderecoempresa.index',$data);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('tempviews.enderecoempresa.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$d=new EnderecoempresaData;
		return $d->show($id);
	}

	public function showvisible ($id) {
		$d=new EnderecoempresaData;
		try {
			if (Enderecoempresa::whereId($id)->count()==0) {
				$res=$d->responsedata(
					'enderecoempresa',
					false,
					'show',
					$d->noexist
					)
				;
				$res=json_encode($res);
				throw new Exception($res);
			}
			$data=array(
				'enderecoempresa' 	=>$d->show($id),
				'header' 	=>$d->header(),
				'id' 		=>$id
				)
			;
			return View::make('tempviews.enderecoempresa.show',$data);
			
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
		$d=new EnderecoempresaData;
		try {
			if (Enderecoempresa::whereId($id)->count()==0) {
				$res=$d->responsedata(
					'enderecoempresa',
					false,
					'edit',
					$d->noexist
					)
				;
				$res=json_encode($res);
				throw new Exception($res);
			}
			$data=array(
				'enderecoempresa' 	=>$d->show($id),
				'header' 	=>$d->header(),
				'id' 		=>$id
				)
			;
			return View::make('tempviews.enderecoempresa.edit',$data);
			
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
		//

		$d=new EnderecoempresaData;

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

			$e=Enderecoempresa::find($id);
			foreach ($success as $key => $value) {
				$e->$key=$value;
			}
			$e->dthr_cadastro	=date('Y-m-d H:i:s');
			$e->sessao_id	=$fake->sessao_id();
			$e->save();

			$res=$d->responsedata(
				'endereco',
				true,
				'update',
				$success
				)
			;
			$code=200;
		}
		catch (Exception $e) {
			SysAdminHelper::NotifyError($e->getMessage());
			$res=$d->responsedata(
				'enderecoempresa',
				false,
				'update',
				$validator->messages()
				)
			;
			$code=400;
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
		//
	}


}
