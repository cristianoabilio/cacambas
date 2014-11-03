<?php

class EstadoCidadeBairroEnderecobaseEnderecoEnderecoempresaData extends StandardResponse{
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
			,array('endereco_id',0)
			,array('tipo',1)
			,array('complemento',1)
			,array('observacao',0)
			,array('status',0)
			,array('dthr_cadastro',0)
			,array('sessao_id',0)
		);	
		return $header;
	}
	//
	public function edata ($endereco) {
		return Endereco::find($endereco)->enderecoempresa;
	}

	public function show($id){
		return Enderecoempresa::find($id);
	}

	public $fillable=array(
		'empresa_id',
		'tipo'
		)
	;

	public $nullable=array(
		'complemento',
		'observacao'
		)
	;

	/**
	* @param formdata returns array with form values
	*/
	public function form_data()
	{
		return $this->formCapture($this->fillable,$this->nullable);
	}

	public function validrules(){
		return array(
			'empresa_id'=>'required',
			'tipo'		=>'required'
			)
		;
	}

}


class EstadoCidadeBairroEnderecobaseEnderecoEnderecoempresaController extends \BaseController {

	public function __construct(){
		$this->beforeFilter('csrf', array('on' => 'post'));
		$this->beforeFilter('geoendereco');
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($estado_id,$cidade_id,$bairro_id,$enderecobase_id,$endereco_id)
	{
		$d=new EstadoCidadeBairroEnderecobaseEnderecoEnderecoempresaData;
		return $d->edata($endereco_id);
	}

	public function visible ($estado_id,$cidade_id,$bairro_id,$enderecobase_id,$endereco_id) {
		$d=new EstadoCidadeBairroEnderecobaseEnderecoEnderecoempresaData;
		//
		$enderecoempresa=$d->edata($endereco_id);
		$header=$d->header();
		return View::make(
			'tempviews.EstadoCidadeBairroEnderecobaseEnderecoEnderecoempresa.index',
			compact(
				'header',
				'enderecoempresa',
				'estado_id',
				'cidade_id',
				'bairro_id',
				'enderecobase_id',
				'endereco_id'
				)
			)
		;
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($estado_id,$cidade_id,$bairro_id,$enderecobase_id,$endereco_id)
	{
		$endereco=Endereco::find($endereco_id);
		return View::make(
			'tempviews.EstadoCidadeBairroEnderecobaseEnderecoEnderecoempresa.create',
			compact(
				//'header',
				//'enderecoempresa',
				'estado_id',
				'cidade_id',
				'bairro_id',
				'enderecobase_id',
				'endereco_id',
				'endereco'
				)
			)
		;
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($estado_id,$cidade_id,$bairro_id,$enderecobase_id,$endereco_id)
	{
		$fake=new fakeuser;

		$d=new EstadoCidadeBairroEnderecobaseEnderecoEnderecoempresaData;

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


			$e=new Enderecoempresa;
			foreach ($success as $key => $value) {
				$e->$key=$value;
			}
			$e->endereco_id=$endereco_id;
			$e->status=1;
			$e->dthr_cadastro	=date('Y-m-d H:i:s');
			$e->sessao_id		=$fake->sessao_id();
			$e->save();
			$success['id']=$e->id;

			$res=$d->responsedata(
				'enderecoempresa',
				true,
				'store',
				$success
				)
			;
			$code=200;
		}
		catch(Exception $e) {
			SysAdminHelper::NotifyError($e->getMessage());
			$res=$d->responsedata(
				'enderecoempresa',
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
	public function show($estado_id,$cidade_id,$bairro_id,$enderecobase_id,$endereco_id,$id)
	{
		$d=new EstadoCidadeBairroEnderecobaseEnderecoEnderecoempresaData;
		return $d->show($id);
	}

	public function showvisible ($estado_id,$cidade_id,$bairro_id,$enderecobase_id,$endereco_id,$id) {
		$d=new EstadoCidadeBairroEnderecobaseEnderecoEnderecoempresaData;
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
				
				)
			;
			$enderecoempresa 	=$d->show($id);
			$header 	=$d->header();
			$endereco=Endereco::find($endereco_id);
			return View::make(
				'tempviews.EstadoCidadeBairroEnderecobaseEnderecoEnderecoempresa.show',
				compact(
					'header',
					'enderecoempresa',
					'estado_id',
					'cidade_id',
					'bairro_id',
					'enderecobase_id',
					'endereco_id',
					'endereco',
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
	public function edit($estado_id,$cidade_id,$bairro_id,$enderecobase_id,$endereco_id,$id)
	{
		$d=new EstadoCidadeBairroEnderecobaseEnderecoEnderecoempresaData;
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
			$enderecoempresa 	=$d->show($id);
			$header 	=$d->header();
			$endereco=Endereco::find($endereco_id);
			return View::make(
				'tempviews.EstadoCidadeBairroEnderecobaseEnderecoEnderecoempresa.edit',
				compact(
					'header',
					'enderecoempresa',
					'estado_id',
					'cidade_id',
					'bairro_id',
					'enderecobase_id',
					'endereco_id',
					'endereco',
					'id'
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
	public function update($estado_id,$cidade_id,$bairro_id,$enderecobase_id,$endereco_id,$id)
	{
		//instantiate fake user (for empresa and sessao)
		//SHOULD BE DELETED IN ORIGINAL PROJECT
		$fake=new fakeuser;
		//

		$d=new EstadoCidadeBairroEnderecobaseEnderecoEnderecoempresaData;

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

			$e=Enderecoempresa::find($id);
			foreach ($success as $key => $value) {
				$e->$key=$value;
			}
			$e->dthr_cadastro	=date('Y-m-d H:i:s');
			$e->sessao_id	=$fake->sessao_id();
			$e->save();

			$res=$d->responsedata(
				'enderecoempresa',
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
	public function destroy($estado_id,$cidade_id,$bairro_id,$enderecobase_id,$endereco_id,$id)
	{
		//
	}


}
