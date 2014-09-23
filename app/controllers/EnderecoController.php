<?php

/**
 * empresaheader class only contains data related to
 * the table Empresa
 */
class enderecodata extends StandardResponse{
	/** 
	* function name: header.
	* @param header with headers of endereco table
	*/
	public function header(){
		/*
		$enderecoheader= headers on table enderecos
		In order to display or hide on HTML table, set as
		1 (visible) or 2 (not shown)
		*/
		$header=
		array(	
			//array('endereco','enderecobase_id',1),
			array('endereco','numero',1),
			array('endereco','cep',0),
			array('endereco','latitude',0),
			array('endereco','longitude',0),
			array('endereco','restricao_hr_inicio',0),
			array('endereco','restricao_hr_fim',0),
			array('enderecobase','bairro_id',1),
			array('enderecobase','cidade_id',0),
			array('enderecobase','estado_id',1),
			array('enderecobase','cep',0),
			array('enderecobase','logradouro',0),
			array('enderecobase','regiao',1),
			array('enderecobase','restricao_hr_inicio',0),
			array('enderecobase','restricao_hr_fim',0),
			array('enderecobase','numero_inicio',0),
			array('enderecobase','numero_fim',0),
			array('enderecoempresa','empresa_id',1),
			array('enderecoempresa','enderecobase_id',1),
			array('enderecoempresa','endereco_id',0),
			array('enderecoempresa','tipo',0),
			array('enderecoempresa','complemento',0),
			array('enderecoempresa','observacao',0),
			array('enderecoempresa','status',1)
			)
		;	
		return $header;
	}
	
	/**
	* @param edata retrieves all data from table "endereco"
	*/
	public function edata ($empresa) {
		return Empresa::find($empresa)->Enderecoempresa;
	}

	public function show($id){
		return Enderecoempresa::find($id);
	}

	/**
	* @param formdata returns array with form values
	*/
	public function formatdata(){

		return array(
			//'enderecobase_id'	=>array( Input::get( 'enderecobase_id'),'endereco'),
			'numero'				=>array( Input::get( 'numero'),'endereco'),
			'cep'					=>array( Input::get( 'cep'),'endereco'),
			'latitude'				=>array( Input::get( 'latitude'),'endereco'),
			'longitude'				=>array( Input::get( 'longitude'),'endereco'),
			'restricao_hr_inicio'	=>array( Input::get( 'restricao_hr_inicio'),'endereco'),
			'restricao_hr_fim'		=>array( Input::get( 'restricao_hr_fim'),'endereco'),
			'bairro_id'				=>array( Input::get( 'bairro_id'),'enderecobase'),
			'cidade_id'				=>array( Input::get( 'cidade_id'),'enderecobase'),
			'estado_id'				=>array( Input::get( 'estado_id'),'enderecobase'),
			'cep'					=>array( Input::get( 'cep'),'enderecobase'),
			'logradouro'			=>array( Input::get( 'logradouro'),'enderecobase'),
			'regiao'				=>array( Input::get( 'regiao'),'enderecobase'),
			'restricao_hr_inicio'	=>array( Input::get( 'restricao_hr_inicio'),'enderecobase'),
			'restricao_hr_fim'		=>array( Input::get( 'restricao_hr_fim'),'enderecobase'),
			'numero_inicio'			=>array( Input::get( 'numero_inicio'),'enderecobase'),
			'numero_fim'			=>array( Input::get( 'numero_fim'),'enderecobase'),
			//'endereco_id'	=>array( Input::get( 'endereco_id'),'enderecoempresa'),
			'tipo'					=>array( Input::get( 'tipo'),'enderecoempresa'),
			'complemento'			=>array( Input::get( 'complemento'),'enderecoempresa'),
			'observacao'			=>array( Input::get( 'observacao'),'enderecoempresa'),
			'status'				=>array( Input::get( 'status'),'enderecoempresa')
			)
		;
	}

	public function validrules(){
		return array(
			'numero'=>	'required'
			,'cep'=>	'required'
			,'latitude'=>	'required'
			,'longitude'=>	'required'
			,'restricao_hr_inicio'=>	'required'
			,'restricao_hr_fim'=>	'required'
			,'bairro_id'=>	'required'
			,'cidade_id'=>	'required'
			,'estado_id'=>	'required'
			//,'cep'=>	'required'
			,'logradouro'=>	'required'
			,'regiao'=>	'required'
			//,'restricao_hr_inicio'=>	'required'
			//,'restricao_hr_fim'=>	'required'
			,'numero_inicio'=>	'required'
			,'numero_fim'=>	'required'
			//,'empresa_id'=>	'required'
			//,'enderecobase_id'=>	'required'
			//,'endereco_id'=>	'required'
			,'tipo'=>	'required'
			,'complemento'=>	'required'
			,'observacao'=>	'required'
			,'status'=>	'required'

			// ,'dthr_cadastro'=> timestamp, not required
			// ,'sessao_id'=> sessao, not required
			)
		;
	}
}

class EnderecoController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$d=new enderecodata;
		$fake=new fakeuser;
		$data=array(
			//retrieve all "endereco"
			'enderecoempresa'=>$d->edata($fake->empresa() ),

			//retrieving table headers
			'header'=>$d->header()
			)
		;
		return View::make('tempviews.endereco.index',$data);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//form for new Empresa
		return
		View::make(
			'tempviews.endereco.create'
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
		//instantiate fake user (for empresa and sessao)
		//SHOULD BE DELETED IN ORIGINAL PROJECT
		$fake=new fakeuser;
		//

		$d=new enderecodata;
		$success=$d->formatdata();
		$succesresponse=array();

		$data_from_enderecobase=array();

		$data_from_endereco=array();

		$data_from_enderecoempresa=array();

		foreach ($success as $key => $value) {
			$succesresponse[$key]=$value[0];

			if ($value[1]=='enderecobase') {
				$data_from_enderecobase[$key]=$value[0];
			}
			else if ($value[1]=='endereco') {
				$data_from_endereco[$key]=$value[0];
			}
			else if ($value[1]=='enderecoempresa') {
				$data_from_enderecoempresa[$key]=$value[0];
			}
		}

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

			$ebase=new Enderecobase;
			foreach ($data_from_enderecobase as $key => $value) {
				$ebase->$key=$value;
			}
			$ebase->dthr_cadastro	=date('Y-m-d H:i:s');
			$ebase->cep 			=Input::get( 'cep');
			$ebase->restricao_hr_inicio=Input::get( 'restricao_hr_inicio');
			$ebase->restricao_hr_fim=Input::get( 'restricao_hr_fim');
			$ebase->dthr_cadastro	=date('Y-m-d H:i:s');
			$ebase->sessao_id		=$fake->sessao_id();

			$ebase->save();

			$enderecobaseid=$ebase->id;

			$e=new Endereco;
			$e->enderecobase_id=	$enderecobaseid;
			foreach ($data_from_endereco as $key => $value) {
				$e->$key=$value;
			}
			$e->dthr_cadastro	=date('Y-m-d H:i:s');
			$e->sessao_id	=$fake->sessao_id();
			//$e->sessao_id	=$this->id_sessao;
			$e->save();

			$e_empresa=new Enderecoempresa;
			$e_empresa->empresa_id=$fake->empresa();
			$e_empresa->enderecobase_id=	$enderecobaseid;
			foreach ($data_from_enderecoempresa as $key => $value) {
				$e_empresa->$key=$value;
			}
			$e_empresa->dthr_cadastro	=date('Y-m-d H:i:s');
			$e_empresa->sessao_id	=$fake->sessao_id();
			//$e_empresa->sessao_id	=$this->id_sessao;
			$e_empresa->save();


			$res=$d->responsedata(
				'Compras',
				true,
				'store',
				$succesresponse
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
		$d=new enderecodata;
		$data=array(
			'endereco' 	=>$d->show($id),
			'header' 	=>$d->header(),
			'id' 		=>$id
			)
		;
		return View::make('tempviews.endereco.show',$data);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$d=new enderecodata;
		$data=array(
			'endereco' 	=>$d->show($id),
			'header' 	=>$d->header(),
			'id' 		=>$id
			)
		;
		return View::make('tempviews.endereco.edit',$data);
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

		$d=new enderecodata;
		$success=$d->formatdata();
		$succesresponse=array();

		$data_from_enderecobase=array();

		$data_from_endereco=array();

		$data_from_enderecoempresa=array();

		foreach ($success as $key => $value) {
			$succesresponse[$key]=$value[0];

			if ($value[1]=='enderecobase') {
				$data_from_enderecobase[$key]=$value[0];
			}
			else if ($value[1]=='endereco') {
				$data_from_endereco[$key]=$value[0];
			}
			else if ($value[1]=='enderecoempresa') {
				$data_from_enderecoempresa[$key]=$value[0];
			}
		}
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

			$e_empresa=Enderecoempresa::find($id);
			//$e_empresa->empresa_id=$fake->empresa();
			//$e_empresa->enderecobase_id=	$enderecobaseid;
			foreach ($data_from_enderecoempresa as $key => $value) {
				$e_empresa->$key=$value;
			}
			$e_empresa->dthr_cadastro	=date('Y-m-d H:i:s');
			$e_empresa->sessao_id	=$fake->sessao_id();
			//$e_empresa->sessao_id	=$this->id_sessao;
			$e_empresa->save();

			$ebase_id=$e_empresa->enderecobase_id;

			$ebase=Enderecobase::find($ebase_id);
			foreach ($data_from_enderecobase as $key => $value) {
				$ebase->$key=$value;
			}
			$ebase->dthr_cadastro	=date('Y-m-d H:i:s');
			$ebase->cep 			=Input::get( 'cep');
			$ebase->restricao_hr_inicio=Input::get( 'restricao_hr_inicio');
			$ebase->restricao_hr_fim=Input::get( 'restricao_hr_fim');
			$ebase->dthr_cadastro	=date('Y-m-d H:i:s');
			$ebase->sessao_id		=$fake->sessao_id();

			$ebase->save();

			$enderecoid=$ebase->endereco->first()->id;

			$e=Endereco::find($enderecoid);
			$e->enderecobase_id=	$ebase_id;
			foreach ($data_from_endereco as $key => $value) {
				$e->$key=$value;
			}
			$e->dthr_cadastro	=date('Y-m-d H:i:s');
			$e->sessao_id	=$fake->sessao_id();
			//$e->sessao_id	=$this->id_sessao;
			$e->save();

			$res=$d->responsedata(
				'Endereco',
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
				'Endereco',
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
		$d=new enderecodata;
		try{
			//$enderecoempresaid=$id;
			$enderecobaseid=Enderecoempresa::find($id)->enderecobase_id;
			$enderecoid=Enderecobase::find($enderecobaseid)->endereco->first()->id;
			
			//Deleting associated records to enderecoempresa
			Endereco::whereId($enderecoid)->delete();
			Enderecobase::whereId($enderecobaseid)->delete();
			Enderecoempresa::whereId($id)->delete();

			//Response
			$res=$d->responsedata(
				'Endereco',
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
				'Endereco',
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
