<?php

class EstadoCidadeBairroEnderecobaseData extends StandardResponse {
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
			array('id',0)
			,array('cep_base',0)
			,array('logradouro',1)
			,array('regiao',1)
			,array('restricao_hr_inicio_base',0)
			,array('restricao_hr_fim_base',0)
			,array('numero_inicio',0)
			,array('numero_fim',0)
		);	
		return $header;
	}

	/**
	* @param edata retrieves all data from table "endereco"
	*/
	public function edata ($bairro_id) {
		return Bairro::find($bairro_id)->enderecobase;
	}

	public function show($id){
		return Enderecobase::find($id);
	}

	/**
	* @param formdata returns array with form values
	*/
	public function form_data(){
		$formdata=array(
			'cep_base'					=>Input::get( 'cep_base'),
			'logradouro'				=>Input::get( 'logradouro'),
			'regiao'					=>Input::get( 'regiao'),
			//'restricao_hr_inicio_base'=>Input::get( 'restricao_hr_inicio_base'),
			//'restricao_hr_fim_base'	=>Input::get( 'restricao_hr_fim_base'),
			'numero_inicio'				=>Input::get( 'numero_inicio'),
			'numero_fim'				=>Input::get( 'numero_fim')
			)
		;

		$nullable=array(
			//'regiao'					=>Input::get( 'regiao')
			'restricao_hr_inicio_base'	=>Input::get( 'restricao_hr_inicio_base'),
			'restricao_hr_fim_base'		=>Input::get( 'restricao_hr_fim_base')
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
			'cep_base'=>	'required',
			'logradouro'=>	'required'
			)
		;
	}


}

class EstadoCidadeBairroEnderecobaseController extends \BaseController {

	public function __construct(){
		$this->beforeFilter('csrf', array('on' => 'post'));
		$this->beforeFilter('geoendereco');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($estado_id,$cidade_id,$bairro_id)
	{
		$d=new EstadoCidadeBairroEnderecobaseData;
		return Response::json($d->edata($bairro_id));
	}

	public function visible ($estado_id,$cidade_id,$bairro_id) {
		$d=new EstadoCidadeBairroEnderecobaseData;
		
		//
		$enderecobase=$d->edata($bairro_id);
		$header=$d->header();
		$bairro=Bairro::find($bairro_id);
		return View::make(
			'tempviews.EstadoCidadeBairroEnderecobase.index',
			compact(
				'header',
				'enderecobase',
				'estado_id',
				'cidade_id',
				'bairro_id',
				'bairro'
				)
			)
		;
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($estado_id,$cidade_id,$bairro_id)
	{
		$bairro=Bairro::find($bairro_id);
		return View::make(
			'tempviews.EstadoCidadeBairroEnderecobase.create',
			compact(
				'estado_id',
				'cidade_id',
				'bairro_id',
				'bairro'
				)
			)
		;
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($estado_id,$cidade_id,$bairro_id)
	{
		$fake=new fakeuser;
		$d=new EstadoCidadeBairroEnderecobaseData;

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

			$e=new Enderecobase;
			$e->bairro_id=$bairro_id;
			foreach ($success as $key => $value) {
				$e->$key=$value;
			}
			$e->dthr_cadastro	=date('Y-m-d H:i:s');
			$e->sessao_id		=$fake->sessao_id();
			$e->save();
			$success['id']=$e->id;
			$res=$d->responsedata(
				'enderecobase',
				true,
				'store',
				$success
				)
			;
			$code=200;
		}
		catch(Exception $e){
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
		return Response::json($res,$code);
		
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($estado_id,$cidade_id,$bairro_id,$id)
	{
		$d=new EstadoCidadeBairroEnderecobaseData;
		return $d->show($id);
	}

	public function showvisible ($estado_id,$cidade_id,$bairro_id,$id) {
		$d=new EstadoCidadeBairroEnderecobaseData;
		try {
			if (Enderecobase::whereId($id)->count()==0) {
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
			//
			$header =$d->header();
			$enderecobase 	=$d->show($id);
			$bairro=Bairro::find($bairro_id);
			return View::make(
				'tempviews.EstadoCidadeBairroEnderecobase.show',
				compact(
					'header',
					'enderecobase',
					'estado_id',
					'cidade_id',
					'bairro_id',
					'bairro',
					'id'
					)
				)
			;
			
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
	public function edit($estado_id,$cidade_id,$bairro_id,$id)
	{
		$d=new EstadoCidadeBairroEnderecobaseData;
		try {
			if (Enderecobase::whereId($id)->count()==0) {
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
			$enderecobase 	=$d->show($id);
			$header 		=$d->header();
			$bairro=Bairro::find($bairro_id);
			//
			return View::make(
				'tempviews.EstadoCidadeBairroEnderecobase.edit',
				compact(
					'enderecobase',
					'header',
					'estado_id',
					'cidade_id',
					'bairro_id',
					'id',
					'bairro'
					#
					)
				)
			;
			
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
	public function update($estado_id,$cidade_id,$bairro_id,$id)
	{
		$fake=new fakeuser;
		$d=new EstadoCidadeBairroEnderecobaseData;
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

			$e=Enderecobase::find($id);
			foreach ($success as $key => $value) {
				$e->$key 	=$value;
			}
			$e->dthr_cadastro	=date('Y-m-d H:i:s');
			$e->sessao_id		=$fake->sessao_id();
			$e->save();	

			//response structure required for angularjs
			$res=$d->responsedata(
				'enderecobase',
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
				'enderecobase',
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
	public function destroy($estado_id,$cidade_id,$bairro_id,$id)
	{
		//
	}


}
