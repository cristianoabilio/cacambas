<?php

/**
 * comprasdata class only contains data related to
 * the table Compras
 */
class ResumoempresaclienteData extends StandardResponse{
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
			array('cliente_id',1)
			,array('mes_referencia',0)
			,array('ano_referencia',0)
			,array('total_locacoes',0)
			,array('total_aberto',0)
			,array('total_recebido',0)
			,array('total_atrasado',0)
		);	
		return $header;
	}
	
	/**
	* @param edata retrieves all data from table "empresa"
	*/
	public function edata ($empresa) {
		return Empresa::find($empresa)->Resumoempresacliente;
	}

	public function show($id){
		return Resumoempresacliente::find($id);
	}

	/**
	* @param formdata returns array with form values
	*/
	public function formatdata(){

		return array(
			'cliente_id'		=>Input::get('cliente_id'),
			'mes_referencia'	=>Input::get('mes_referencia'),
			'ano_referencia'	=>Input::get('ano_referencia'),
			'total_locacoes'	=>Input::get('total_locacoes'),
			'total_aberto'		=>Input::get('total_aberto'),
			'total_recebido'	=>Input::get('total_recebido'),
			'total_atrasado'	=>Input::get('total_atrasado')
			)
		;
	}

	public function validrules(){
		return array(
			'cliente_id'		=>	'required'
			,'mes_referencia'	=>	'required'
			,'ano_referencia'	=>	'required'
			,'total_locacoes'	=>	'required'
			,'total_aberto'		=>	'required'
			,'total_recebido'	=>	'required'
			,'total_atrasado'	=>	'required'
			
			)
		;
	}

}

class ResumoempresaclienteController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$fake=new fakeuser;
		$d=new ResumoempresaclienteData;
		$data=array(
			//all compras
			'resumoempresacliente'=>$d->edata($fake->empresa()),
			'header'=>$d->header()
			)
		;
		return View::make('tempviews.ResumoEmpresaCliente.index',$data);

	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('tempviews.ResumoEmpresaCliente.create');

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

		$d=new ResumoempresaclienteData;
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

			$e=new Resumoempresacliente;
			$e->empresa_id = $fake->empresa();	
			foreach ($success as $key => $value) {
				$e->$key 	=$value;
			}
			$e->save();	

			$res=$d->responsedata(
				'resumoempresacliente',
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
				'resumoempresacliente',
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
		$d=new ResumoempresaclienteData;
		$data=array(
			'resumoempresacliente'	=>$d->show($id),
			'header'				=>$d->header(),
			'id'					=>$id
			)
		;
		return View::make('tempviews.ResumoEmpresaCliente.show',$data);

	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$d=new ResumoempresaclienteData;
		$data=array(
			'resumoempresacliente'	=>$d->show($id),
			'header'				=>$d->header(),
			'id'					=>$id
			)
		;
		return View::make('tempviews.ResumoEmpresaCliente.edit',$data);
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

		$d=new ResumoempresaclienteData;
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

			$e=Resumoempresacliente::find($id);
			foreach ($success as $key => $value) {
				$e->$key 	=$value;
			}
			$e->save();	

			//response structure required for angularjs
			$res=$d->responsedata(
				'resumoempresacliente',
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
				'resumoempresacliente',
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
	// public function destroy($id)
	// {
	// 	//
	// }


}
