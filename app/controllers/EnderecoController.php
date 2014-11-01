<?php

/**
 * empresaheader class only contains data related to
 * the table Empresa
 */
class EnderecoData extends StandardResponse{
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
	public function edata () {
		return Endereco::all();
	}

	public function show($id){
		return Endereco::find($id);
	}

	/**
	* @param formdata returns array with form values
	*/
	public function formatdata(){
		$formatdata=array(
			//'enderecobase_id'	=>array( Input::get( 'enderecobase_id'),'endereco'),
			'numero'				=>Input::get( 'numero'),
			'cep'					=>Input::get( 'cep'),
			'latitude'				=>Input::get( 'latitude'),
			'longitude'				=>Input::get( 'longitude'),
			'restricao_hr_inicio'	=>Input::get( 'restricao_hr_inicio'),
			'restricao_hr_fim'		=>Input::get( 'restricao_hr_fim')
			)
		;

		$nullable=array(
			//restricao_hr_inicio,restricao_hr_fim,complemento,observacao
			)
		;

		foreach ($nullable as $key => $value) {
			if ( trim($value[0])!="" ) {
				$formdata[$key]=$value;
			}
		}

		return $formatdata;
	}

	public function validrules(){
		return array(
			'numero'	=>	'required'
			,'cep'		=>	'required|integer'
			)
		;
	}
}


class EnderecoController extends \BaseController {

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
		$d=new EnderecoData;
		return $d->edata();
	}

	public function visible () {
		$d=new EnderecoData;
		$data=array(
			'endereco'=>$d->edata(),
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
		return View::make('tempviews.endereco.create');
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
		$d=new EnderecoData;
		return $d->show($id);
	}

	public function showvisible($id)
	{
		$d=new EnderecoData;
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
			$data=array(
				'endereco' 	=>$d->show($id),
				'header' 	=>$d->header(),
				'id' 		=>$id
				)
			;
			return View::make('tempviews.endereco.show',$data);
			
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
		$d=new EnderecoData;
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
				'endereco' 	=>$d->show($id),
				'header' 		=>$d->header(),
				'id' 			=>$id
				)
			;
			return View::make('tempviews.endereco.edit',$data);
			
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
		$d=new EnderecoData;
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
	public function destroy($id)
	{
		//
	}


}