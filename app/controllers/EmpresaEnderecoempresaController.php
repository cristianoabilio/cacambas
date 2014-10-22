<?php

/**
 * empresaheader class only contains data related to
 * the table Empresa
 */
class EmpresaEnderecoempresaData extends StandardResponse{
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
			array('endereco','numero',0),
			array('endereco','cep',1),
			array('endereco','latitude',0),
			array('endereco','longitude',0),
			array('endereco','restricao_hr_inicio',0),
			array('endereco','restricao_hr_fim',0),
			array('enderecobase','bairro_id',0),
			array('enderecobase','cidade_id',0),
			array('enderecobase','estado_id',0),
			array('enderecobase','cep_base',0),
			array('enderecobase','logradouro',0),
			array('enderecobase','regiao',1),
			array('enderecobase','restricao_hr_inicio_base',0),
			array('enderecobase','restricao_hr_fim_base',0),
			array('enderecobase','numero_inicio',0),
			array('enderecobase','numero_fim',0),
			array('enderecoempresa','empresa_id',0),
			array('enderecoempresa','enderecobase_id',0),
			array('enderecoempresa','endereco_id',0),
			array('enderecoempresa','tipo',0),
			array('enderecoempresa','complemento',0),
			array('enderecoempresa','observacao',0),
			array('enderecoempresa','status',0)
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
		$formatdata=array(
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
			'cep_base'				=>array( Input::get( 'cep_base'),'enderecobase'),
			'restricao_hr_inicio_base'	=>array( Input::get( 'restricao_hr_inicio_base'),'enderecobase'),
			'restricao_hr_fim_base'		=>array( Input::get( 'restricao_hr_fim_base'),'enderecobase'),
			'logradouro'			=>array( Input::get( 'logradouro'),'enderecobase'),
			'regiao'				=>array( Input::get( 'regiao'),'enderecobase'),
			'numero_inicio'			=>array( Input::get( 'numero_inicio'),'enderecobase'),
			'numero_fim'			=>array( Input::get( 'numero_fim'),'enderecobase'),
			//'endereco_id'	=>array( Input::get( 'endereco_id'),'enderecoempresa'),
			'tipo'					=>array( Input::get( 'tipo'),'enderecoempresa'),
			'status'				=>array( Input::get( 'status'),'enderecoempresa')
			)
		;

		$nullable=array(
			//restricao_hr_inicio,restricao_hr_fim,complemento,observacao
			'restricao_hr_inicio_base'	=>array( Input::get( 'restricao_hr_inicio'),'enderecobase'),
			'restricao_hr_fim_base'		=>array( Input::get( 'restricao_hr_fim'),'enderecobase'),
			'complemento'			=>array( Input::get( 'complemento'),'enderecoempresa'),
			'observacao'			=>array( Input::get( 'observacao'),'enderecoempresa')
			)
		;

		foreach ($nullable as $key => $value) {
			if ( trim($value[0])!="" ) {
				$formdata[$key]=$value;
			}
			else {
				$formdata[$key]=null;
			}
		}

		return $formatdata;
	}

	public function validrules(){
		return array(
			'numero'=>	'required'
			,'cep'=>	'required|integer'
			/*
			,'latitude'=>	'required'
			,'longitude'=>	'required'
			,'restricao_hr_inicio'=>	'required'
			,'restricao_hr_fim'=>	'required'*/
			,'bairro_id'=>	'required|integer'
			,'cidade_id'=>	'Required|integer'
			,'estado_id'=>	'Required|integer'
			,'cep_base'=>	'required'
			,'logradouro'=>	'required'
			//,'regiao'=>	'required'
			//,'restricao_hr_inicio'=>	'required'
			//,'restricao_hr_fim'=>	'required'
			/*,'numero_inicio'=>	'required'
			,'numero_fim'=>	'required'*/
			//,'empresa_id'=>	'required'
			//,'enderecobase_id'=>	'required'
			//,'endereco_id'=>	'required'
			,'tipo'=>	'required'
			/*,'complemento'=>	'required'
			,'observacao'=>	'required'
			,'status'=>	'required'*/

			// ,'dthr_cadastro'=> timestamp, not required
			// ,'sessao_id'=> sessao, not required
			)
		;
	}
}

class EmpresaEnderecoempresaController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index ($empresa_id) {
		$d=new EmpresaEnderecoempresaData;
		return $d->edata($empresa_id);
	}
	public function visible($empresa_id)
	{
		$d=new EmpresaEnderecoempresaData;
		$data=array(
			'enderecoempresa'	=>$d->edata($empresa_id),
			'header'			=>$d->header(),
			'empresa_id'				=>$empresa_id
			)
		;
		return View::make('tempviews.EmpresaEnderecoempresa.index',$data);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($id)
	{
		//form for new Empresa
		return
		View::make(
			'tempviews.EmpresaEnderecoempresa.create',
			compact('id')
			)
		;
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($id)
	{
		//instantiate fake user (for empresa and sessao)
		//SHOULD BE DELETED IN ORIGINAL PROJECT
		$fake=new fakeuser;
		//

		$d=new EmpresaEnderecoempresaData;
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
			$ebase->sessao_id		=$fake->sessao_id();

			$ebase->save();

			$enderecobaseid=$ebase->id;

			//adding id to success array
			$succesresponse['enderecobase_id']=$enderecobaseid;

			$e=new Endereco;
			$e->enderecobase_id=	$enderecobaseid;
			foreach ($data_from_endereco as $key => $value) {
				$e->$key=$value;
			}
			$e->dthr_cadastro	=date('Y-m-d H:i:s');
			$e->sessao_id	=$fake->sessao_id();
			//$e->sessao_id	=$this->id_sessao;
			$e->save();

			//adding id to success array
			$succesresponse['endereco_id']=$e->id;

			$e_empresa=new Enderecoempresa;
			$e_empresa->$id;
			$e_empresa->enderecobase_id=	$enderecobaseid;
			foreach ($data_from_enderecoempresa as $key => $value) {
				$e_empresa->$key=$value;
			}
			$e_empresa->dthr_cadastro	=date('Y-m-d H:i:s');
			$e_empresa->sessao_id	=$fake->sessao_id();
			//$e_empresa->sessao_id	=$this->id_sessao;
			$e_empresa->save();

			//adding id to success array
			$succesresponse['enderecoempresa_id']=$e_empresa->id;


			$res=$d->responsedata(
				'endereco',
				true,
				'store',
				$succesresponse
				)
			;
			$code=200;


		} catch (Exception $e){
			SysAdminHelper::NotifyError($e->getMessage());
			$res=$d->responsedata(
				'endereco',
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
	public function show ($empresa_id,$id) {
		$d=new EmpresaEnderecoempresaData;
		return $d->show($id);
	}
	public function showvisible($empresa_id,$id)
	{
		$d=new EmpresaEnderecoempresaData;
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
				'endereco' 	=>$d->show($id),
				'header' 	=>$d->header(),
				'empresa_id'=>$empresa_id,
				'id' 		=>$id
				)
			;
			return View::make('tempviews.EmpresaEnderecoempresa.show',$data);
			
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
		$d=new EmpresaEnderecoempresaData;
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
				'empresa_id'=>$empresa_id,
				'id' 		=>$id
				)
			;
			return View::make('tempviews.EmpresaEnderecoempresa.edit',$data);
			
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
		//

		$d=new EmpresaEnderecoempresaData;
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
				'endereco',
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
				'endereco',
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
	public function destroy($empresa_id,$id)
	{
		$d=new EmpresaEnderecoempresaData;
		try{

			if (Enderecoempresa::whereId($id)->count()==0) {
				throw new Exception(json_encode($d->noexist));
			}


			//$enderecoempresaid=$id;
			$enderecobaseid=Enderecoempresa::find($id)->enderecobase_id;
			$enderecoid=Enderecobase::find($enderecobaseid)->endereco->first()->id;
			
			//Deleting associated records to enderecoempresa
			Endereco::whereId($enderecoid)->delete();
			Enderecobase::whereId($enderecobaseid)->delete();
			Enderecoempresa::whereId($id)->delete();

			//Response
			$res=$d->responsedata(
				'endereco',
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
				'endereco',
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
