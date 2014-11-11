<?php

class EstadoCidadeBairroEnderecobaseEnderecoData extends StandardResponse{
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
			array('numero',0),
			array('cep',1),
			array('latitude',0),
			array('longitude',0),
			array('restricao_hr_inicio',0),
			array('restricao_hr_fim',0)
			)
		;	
		return $header;
	}
	
	/**
	* @param edata retrieves all data from table "endereco"
	*/
	public function edata ($enderecobase) {
		return Enderecobase::find($enderecobase)->endereco;
	}

	public function show($id){
		return Endereco::find($id);
	}

	/**
	* @param formdata returns array with form values
	*/

	public $fillable=array(
		'numero',
		'cep',
		'latitude',
		'longitude',
		'restricao_hr_inicio',
		'restricao_hr_fim'
		)
	;

	public $nullable=array();

	public function form_data(){
		return $this->formCapture($this->fillable,$this->nullable);
	}

	public function validrules(){
		return array(
			'numero'	=>	'required'
			,'cep'		=>	'required|integer'
			)
		;
	}
}

class EstadoCidadeBairroEnderecobaseEnderecoController extends \BaseController {

	public function __construct(){
		//$this->beforeFilter('csrf', array('on' => 'post'));
		$this->beforeFilter('geoendereco');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($estado_id,$cidade_id,$bairro_id,$endebase_id)
	{
		$d=new EstadoCidadeBairroEnderecobaseEnderecoData;
		return $d->edata($endebase_id);
	}

	public function visible ($estado_id,$cidade_id,$bairro_id,$endebase_id) {
		$d=new EstadoCidadeBairroEnderecobaseEnderecoData;
		
		$header=$d->header();
		$endereco=$d->edata($endebase_id);
		$enderecobase=Enderecobase::find($endebase_id);

		return View::make(
			'tempviews.EstadoCidadeBairroEnderecobaseEndereco.index',
			compact(
				'header',
				'estado_id',
				'cidade_id',
				'bairro_id',
				'endebase_id',
				'enderecobase',
				'endereco'
				)
			)
		;
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($estado_id,$cidade_id,$bairro_id,$endebase_id)
	{
		$enderecobase=Enderecobase::find($endebase_id);
		return View::make(
			'tempviews.EstadoCidadeBairroEnderecobaseEndereco.create',
			compact(
				'estado_id',
				'cidade_id',
				'bairro_id',
				'endebase_id',
				'endereco',
				'enderecobase'
				)
			)
		;
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($estado_id,$cidade_id,$bairro_id,$endebase_id)
	{
		$fake=new fakeuser;
		$d=new EstadoCidadeBairroEnderecobaseEnderecoData;
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

			$e=new Endereco;
			$e->enderecobase_id=$endebase_id;
			foreach ($success as $key => $value) {
				$e->$key=$value;
			}
			$e->dthr_cadastro	=date('Y-m-d H:i:s');
			$e->sessao_id		=$fake->sessao_id();
			$e->save();
			$success['id']=$e->id;
			$res=$d->responsedata(
				'endereco',
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
	public function show($estado_id,$cidade_id,$bairro_id,$endebase_id,$id)
	{
		$d=new EstadoCidadeBairroEnderecobaseEnderecoData;
		return $d->show($id);
	}

	public function showvisible($estado_id,$cidade_id,$bairro_id,$endebase_id,$id)
	{
		$d=new EstadoCidadeBairroEnderecobaseEnderecoData;
		try {
			if (Endereco::whereId($id)->count()==0) {
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

			$header=$d->header();
			$endereco=$d->show($id);

			return View::make(
				'tempviews.EstadoCidadeBairroEnderecobaseEndereco.show',
				compact(
					'estado_id',
					'cidade_id',
					'bairro_id',
					'endebase_id',
					'endereco',
					'header',
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
	public function edit($estado_id,$cidade_id,$bairro_id,$endebase_id,$id)
	{
		$d=new EstadoCidadeBairroEnderecobaseEnderecoData;
		try {
			if (Endereco::whereId($id)->count()==0) {
				$res=$d->responsedata(
					'endereco',
					false,
					'edit',
					$d->noexist
					)
				;
				$res=json_encode($res);
				throw new Exception($res);
			}

			$header=$d->header();
			$endereco=$d->show($id);
			#
			$data=array(
				'endereco' 	=>$d->show($id),
				'header' 		=>$d->header(),
				'id' 			=>$id
				)
			;
			return View::make(
				'tempviews.EstadoCidadeBairroEnderecobaseEndereco.edit',
				compact(
					'estado_id',
					'cidade_id',
					'bairro_id',
					'endebase_id',
					'endereco',
					'header',
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
	public function update($estado_id,$cidade_id,$bairro_id,$endebase_id,$id)
	{
		$fake=new fakeuser;
		$d=new EstadoCidadeBairroEnderecobaseEnderecoData;
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

			$e=Endereco::find($id);
			foreach ($success as $key => $value) {
				$e->$key 	=$value;
			}
			$e->dthr_cadastro	=date('Y-m-d H:i:s');
			$e->sessao_id		=$fake->sessao_id();
			$e->save();	

			//response structure required for angularjs
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
	public function destroy($estado_id,$cidade_id,$bairro_id,$endebase_id,$id)
	{
		//
	}


}
