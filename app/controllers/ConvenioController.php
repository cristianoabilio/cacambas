<?php
class conveniodata extends StandardResponse{
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
			array('plano_id',1)
			,array('limite_id',0)
			,array('total_nfse',0)
			,array('dia_fatura',0)
			,array('tipo_pagamento',0)
			,array('dt_inicio',0)
			,array('dt_fim',0)
			// ,array('dthr_cadastro',0)
			// ,array('sessao_id',0)


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

	/**
	* @param formdata returns array with form values
	*/
	public function formatdata(){

		return array(
			'plano_id'			=>Input::get('plano_id'),
			'limite_id'			=>Input::get('limite_id'),
			'total_nfse'		=>Input::get('total_nfse'),
			'dia_fatura'		=>Input::get('dia_fatura'),
			'tipo_pagamento'	=>Input::get('tipo_pagamento'),
			'dt_inicio'			=>Input::get('dt_inicio'),
			'dt_fim'			=>Input::get('dt_fim')
			)
		;
	}

	public function validrules(){
		return array(
			'plano_id'=>		'required'
			,'dia_fatura'=>		'required'
			,'tipo_pagamento'=>	'required'
			,'dt_inicio'=>		'required'
			,'dt_fim'=>			'required'
			// ,'dthr_cadastro'=> timestamp, not required
			// ,'sessao_id'=> sessao, not required
			)
		;
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
		//instantiate fake user (for empresa and sessao)
		//SHOULD BE DELETED IN ORIGINAL PROJECT
		$fake=new fakeuser;
		//

		$d=new conveniodata;

		$success= $d->formatdata();
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

			$e=new Convenio;
			$e->empresa_id		=$fake->empresa();
			foreach ($success as $key => $value) {
				$e->$key 	=$value;
			}

			$e->dthr_cadastro	=date('Y-m-d H:i:s');
			$e->sessao_id		=$fake->sessao_id();
			//$e->sessao_id	=$this->id_sessao;

			$e->save();	



			$res=$d->responsedata(
				'Convenio',
				true,
				'store',
				$success
				)
			;
			$code=200;


		} catch (Exception $e){
			SysAdminHelper::NotifyError($e->getMessage());
			$res=$d->responsedata(
				'Compras',
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
		//instantiate fake user (for empresa and sessao)
		//SHOULD BE DELETED IN ORIGINAL PROJECT
		$fake=new fakeuser;
		//
		$d=new conveniodata;
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

			$e=Convenio::find($id);	
			$e->empresa_id	=$fake->empresa();
			foreach ($success as $key => $value) {
				$e->$key 	=$value;
			}
			$e->dthr_cadastro	=date('Y-m-d H:i:s');
			$e->sessao_id	=$fake->sessao_id();
			//$e->sessao_id	=$this->id_sessao;

			$e->save();

			$res=$d->responsedata(
				'Convenio',
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
				'Convenio',
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
	/*public function destroy($id)
	{
		//
	}*/


}
