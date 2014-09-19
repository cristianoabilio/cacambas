<?php
class conveniodata{
	/** 
	* function name: header.
	* @param header with headers of convenio table
	*/
	public function header(){
		/*
		$enderecoheader= headers on table enderecos
		In order to display or hide on HTML table, set as
		1 (visible) or 2 (not shown)
		*/
		$convenioheader=array(	
			array('IDEmpresa',1)
			,array('IDPlano',1)
			,array('IDLimite',0)
			,array('total_nfse',0)
			,array('dia_fatura',0)
			,array('tipo_pagamento',0)
			,array('dt_inicio',0)
			,array('dt_fim',0)
			,array('dthr_cadastro',0)
			,array('IDSessao',0)


			)
		;	
		return $convenioheader;
	}
	
	/**
	* @param edata retrieves all data from table "limite"
	*/
	public function edata () {
		return Convenio::all();
	}

	public function show($id){
		return Convenio::find($id);
	}
}

class ConvenioController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$d=new conveniodata;

		$data=array(
			'header' 	=> $d->header(),
			'convenio'	=> $d->edata()
			)
		;
		return View::make('tempviews.convenio.index',$data);


	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		
		return View::make('tempviews.convenio.create');

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
					'IDEmpresa'=>		'required'
					,'IDPlano'=>		'required'
					,'IDLimite'=>		'required'
					,'total_nfse'=>		'required'
					,'dia_fatura'=>		'required'
					,'tipo_pagamento'=>	'required'
					,'dt_inicio'=>		'required'
					,'dt_fim'=>			'required'
					,'dthr_cadastro'=>	'required'
					,'IDSessao'=>		'required'
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

			$e=new Convenio;
			$e->IDEmpresa	=Input::get('IDEmpresa');
			$e->IDPlano	=Input::get('IDPlano');
			$e->IDLimite	=Input::get('IDLimite');
			$e->total_nfse	=Input::get('total_nfse');
			$e->dia_fatura	=Input::get('dia_fatura');
			$e->tipo_pagamento	=Input::get('tipo_pagamento');
			$e->dt_inicio	=Input::get('dt_inicio');
			$e->dt_fim	=Input::get('dt_fim');
			$e->dthr_cadastro	=Input::get('dthr_cadastro');
			$e->IDSessao	=Input::get('IDSessao');

			$e->save();	



			$res=$res = array(
				'status'=>'success',
				'msg' => 'SUCCESFULLY SAVED!'
				)
			;


		} catch (Exception $e){
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
		$d=new conveniodata;
		$data=array(
			'convenio' 	=>$d->show($id),
			'header' 	=>$d->header(),
			'id' 		=>$id
			)
		;
		return View::make('tempviews.convenio.show',$data);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$d=new conveniodata;
		$data=array(
			'convenio' 	=>$d->show($id),
			'header' 	=>$d->header(),
			'id' 		=>$id
			)
		;
		return View::make('tempviews.convenio.edit',$data);
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
					'IDEmpresa'=>		'required'
					,'IDPlano'=>		'required'
					,'IDLimite'=>		'required'
					,'total_nfse'=>		'required'
					,'dia_fatura'=>		'required'
					,'tipo_pagamento'=>	'required'
					,'dt_inicio'=>		'required'
					,'dt_fim'=>			'required'
					,'dthr_cadastro'=>	'required'
					,'IDSessao'=>		'required'
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

			$e=Convenio::find($id);	
			$e->IDEmpresa	=Input::get('IDEmpresa');
			$e->IDPlano	=Input::get('IDPlano');
			$e->IDLimite	=Input::get('IDLimite');
			$e->total_nfse	=Input::get('total_nfse');
			$e->dia_fatura	=Input::get('dia_fatura');
			$e->tipo_pagamento	=Input::get('tipo_pagamento');
			$e->dt_inicio	=Input::get('dt_inicio');
			$e->dt_fim	=Input::get('dt_fim');
			$e->dthr_cadastro	=Input::get('dthr_cadastro');
			$e->IDSessao	=Input::get('IDSessao');

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
	/*public function destroy($id)
	{
		//
	}*/


}
