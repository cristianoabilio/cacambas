<?php

class EnderecobaseData extends StandardResponse {
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
			,array('bairro_id',0)
			,array('cidade_id',0)
			,array('estado_id',0)
			,array('cep_base',0)
			,array('logradouro',1)
			,array('regiao',1)
			,array('restricao_hr_inicio',0)
			,array('restricao_hr_fim',0)
			,array('numero_inicio',0)
			,array('numero_fim',0)
			,array('dthr_cadastro',0)
			,array('sessao_id',0)
		);	
		return $header;
	}

	/**
	* @param edata retrieves all data from table "endereco"
	*/
	public function edata () {
		return Enderecobase::all();
	}

	public function show($id){
		return Enderecobase::find($id);
	}

	/**
	* @param formdata returns array with form values
	*/
	public function form_data(){
		$formdata=array(
			'bairro_id'					=>Input::get( 'bairro_id'),
			'cidade_id'					=>Input::get( 'cidade_id'),
			'estado_id'					=>Input::get( 'estado_id'),
			'cep_base'					=>Input::get( 'cep_base'),
			'restricao_hr_inicio_base'	=>Input::get( 'restricao_hr_inicio_base'),
			'restricao_hr_fim_base'		=>Input::get( 'restricao_hr_fim_base'),
			'logradouro'				=>Input::get( 'logradouro'),
			'regiao'					=>Input::get( 'regiao'),
			'numero_inicio'				=>Input::get( 'numero_inicio'),
			'numero_fim'				=>Input::get( 'numero_fim')
			)
		;

		$nullable=array(
			'restricao_hr_inicio_base'	=>Input::get( 'restricao_hr_inicio'),
			'restricao_hr_fim_base'		=>Input::get( 'restricao_hr_fim')
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
			'bairro_id'=>	'required|integer'
			,'cidade_id'=>	'Required|integer'
			,'estado_id'=>	'Required|integer'
			,'cep_base'=>	'required'
			,'logradouro'=>	'required'
			)
		;
	}


}

class EnderecobaseController extends \BaseController {

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
		$d=new EnderecobaseData;
		return Response::json($d->edata());
	}

	public function visible () {
		$d=new EnderecobaseData;
		$data=array(
			'enderecobase'=>$d->edata(),
			'header'=>$d->header()
			)
		;
		return View::make('tempviews.enderecobase.index',$data);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('tempviews.enderecobase.create');
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
		$d=new EnderecobaseData;
		return $d->show($id);
	}

	public function showvisible ($id) {
		$d=new EnderecobaseData;
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
			$data=array(
				'enderecobase' 	=>$d->show($id),
				'header' 	=>$d->header(),
				'id' 		=>$id
				)
			;
			return View::make('tempviews.enderecobase.show',$data);
			
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
		$d=new EnderecobaseData;
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
				'enderecobase' 	=>$d->show($id),
				'header' 		=>$d->header(),
				'id' 			=>$id
				)
			;
			return View::make('tempviews.enderecobase.edit',$data);
			
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
		$fake=new fakeuser;
		$d=new EnderecobaseData;
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
	public function destroy($id)
	{
		//
	}


}
