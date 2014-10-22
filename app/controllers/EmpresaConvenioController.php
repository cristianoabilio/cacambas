<?php

class EmpresaConvenioData extends StandardResponse{
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
		$header=array(	
			array('plano_id',1)
			,array('dia_fatura',0)
			,array('tipo_pagamento',0)
			,array('dt_inicio',0)
			,array('dt_fim',0)
			)
		;	
		return $header;
	}

	public function limiteHeader() {
		return array(
			'motoristas',
			'caminhoes',
			'rastreamento',
			'cacambas',
			'NFSe',
			'manutencao',
			'pagamentos',
			'fluxo_caixa',
			'relatorio_avancado',
			'benchmarks'
			)
		;
	}
	/*
	
			*/
	
	/**
	* @param edata retrieves all data from table "limite"
	*/
	public function edata ($empresa_id) {
		return Empresa::find($empresa_id)->Convenio;
	}

	public function show($id){
		return Convenio::find($id);
	}

	/**
	* @param formdata returns array with form values
	*/
	public function formatdata(){

		$form_data=array(
			'plano_id'		=>Input::get('plano_id'),
			'tipo_pagamento'=>Input::get('tipo_pagamento'),
			'dt_inicio'		=>Input::get('dt_inicio'),
			//
			//plano_custom required for detecting between
			//default or customized  plano
			'plano_custom'	=>Input::get('plano_custom')
			)
		;

		$nullable=array(
			'dt_fim'		=>Input::get('dt_fim'),
			//'limite_id'		=>Input::get('limite_id'),
			)
		;

		$autoasigned=array(
			'dia_fatura'	=>Input::get('dia_fatura')
			)
		;

		foreach ($nullable as $k => $v) {
			if (trim($v)!='') {
				$form_data[$k]=$v;
			} else {
				$form_data[$k]=null;
			}
		}

		foreach ($autoasigned as $k => $v) {
			if (trim($v)!='') {
				$form_data[$k]=$v;
			} else {
				$form_data[$k]=5;
			}
		}

		return $form_data;
	}

	public function formatDataFromLimite() {
		return array(
			'motoristas'			=>Input::get('motoristas'),
			'caminhoes'				=>Input::get('caminhoes'),
			'rastreamento'			=>Input::get('rastreamento'),
			'cacambas'				=>Input::get('cacambas'),
			'NFSe'					=>Input::get('NFSe'),
			'manutencao'			=>Input::get('manutencao'),
			'pagamentos'			=>Input::get('pagamentos'),
			'fluxo_caixa'			=>Input::get('fluxo_caixa'),
			'relatorio_avancado'	=>Input::get('relatorio_avancado'),
			'benchmarks'			=>Input::get('benchmarks')
			)
		;
	}

	public function validrules(){
		$rules=array(
			//
			//rules for convenio
			'plano_id'			=>'required|integer'
			,'tipo_pagamento'	=>'required|integer'
			,'dt_inicio'		=>'required|date'
			//
			//required for saving default or custom plano
			,'plano_custom'		=>'required'
			)
		;

		$limiterules=array(
			//
			//rules for limite
			'motoristas'		=>	'required|integer'
			,'caminhoes'		=>	'required|integer'
			,'rastreamento'		=>	'required|integer'
			,'cacambas'			=>	'required|integer'
			,'NFSe'				=>	'required|integer'
			,'manutencao'		=>	'required|boolean'
			,'pagamentos'		=>	'required|boolean'
			,'fluxo_caixa'		=>	'required|boolean'
			,'relatorio_avancado'=>	'required|boolean'
			,'benchmarks'		=>	'required|boolean'
			)
		;
		if ( trim(Input::get('plano_custom'))=='custom' ) {
			$rules=array_merge($rules, $limiterules);
		}
		return $rules;
	}
}

class EmpresaConvenioController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($empresa_id)
	{
		$d=new EmpresaConvenioData;
		return Response::json($d->edata($empresa_id));
	}

	public function visible ($empresa_id) {
		$d=new EmpresaConvenioData;

		$data=array(
			'header' 	=> $d->header(),
			'convenio'	=> $d->edata($empresa_id),
			'empresa_id'	=> $empresa_id
			)
		;
		return View::make('tempviews.EmpresaConvenio.index',$data);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($empresa_id)
	{
		$d=new EmpresaConvenioData;
		$limite_h=$d->limiteHeader();
		$data=compact('empresa_id','limite_h');
		return View::make('tempviews.EmpresaConvenio.create',$data);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($empresa_id)
	{
		//instantiate fake user (for empresa and sessao)
		//SHOULD BE DELETED IN ORIGINAL PROJECT
		$fake=new fakeuser;
		//

		$d=new EmpresaConvenioData;

		$success= $d->formatdata();

		$success_convenio=$success;

		$success_limite=$d->formatDataFromLimite();
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

			//Saving customized limite data if choosen
			if ($success['plano_custom']=='custom') {
				$e_limite=new Limite;
				foreach ($success_limite as $key => $value) {
					$e_limite->$key 	=$value;
					$success[$key]		=$value;
				}
				$e_limite->sessao_id	=$fake->sessao_id();
				//$e_limite->sessao_id	=$this->id_sessao;
				$e_limite->dthr_cadastro=date('Y-m-d H:i:s');
				$e_limite->save();
				$success['limite_id']=$e_limite->id;
			}
			//leaving default limite related to plano
			else if ($success['plano_custom']=='default') {
				$success['limite_id']=null;
			}

			$e=new Convenio;
			$e->limite_id=$success['limite_id'];
			$e->empresa_id		=$empresa_id;
			foreach ($success_convenio as $key => $value) {

				//overiding plano_custom as it is not part of convenio table
				if ($key!='plano_custom') {
					$e->$key 	=$value;
				}
				
			}
			$e->status=1;

			$e->dthr_cadastro	=date('Y-m-d H:i:s');
			$e->sessao_id		=$fake->sessao_id();
			//$e->sessao_id	=$this->id_sessao;

			$e->save();

			$success['id']=$e->id;

			$res=$d->responsedata(
				'convenio',
				true,
				'store',
				$success
				)
			;
			$code=200;


		} catch (Exception $e){
			SysAdminHelper::NotifyError($e->getMessage());
			$res=$d->responsedata(
				'convenio',
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
	public function show($empresa_id,$id)
	{
		$d=new EmpresaConvenioData;
		return $d->show($id);
	}

	public function showvisible ($empresa_id,$id) {
		$d=new EmpresaConvenioData;
		try {
			if (Convenio::whereId($id)->count()==0) {
				$res=$d->responsedata(
					'convenio',
					false,
					'show',
					$d->noexist
					)
				;
				$res=json_encode($res);
				throw new Exception($res);
			}
			$convenio=$d->show($id);
			if ($convenio->limite==null) {
				$limite=$convenio->limite;
			} else {
				$limite=$convenio->plano->limite;
			}
			$header=$d->header();

			return View::make('tempviews.EmpresaConvenio.show',
				compact(
					'convenio',
					'header',
					'limite',
					'empresa_id',
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
	public function edit($empresa_id,$id)
	{
		$d=new EmpresaConvenioData;
		try {
			if (
				Convenio::whereId($id)
				->count()==0
				) {
				$msg=array();
				$res=$d->responsedata(
					'convenio',
					false,
					'edit',
					$d->noexist
					)
				;
				$res=json_encode($res);
				throw new Exception($res);
			}
			$convenio=$d->show($id);
			if ($convenio->limite!=null) {
				$limite=$convenio->limite;
			} else {
				$limite=$convenio->plano->limite;
			}
			$header=$d->header();
			$limiteheader=$d->limiteHeader();

			return View::make(
				'tempviews.EmpresaConvenio.edit',
				compact(
					'convenio',
					'header',
					'limiteheader',
					'limite',
					'empresa_id',
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
	public function update($empresa_id,$id)
	{
		$fake=new fakeuser;
		//
		$d=new EmpresaConvenioData;

		$success=			$d->formatdata();

		$success_limite=	$d->formatDataFromLimite();

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
			//$e->empresa_id	=$fake->empresa();
			foreach ($success as $key => $value) {
				$e->$key 	=$value;
			}
			$e->dthr_cadastro	=date('Y-m-d H:i:s');
			$e->sessao_id	=$fake->sessao_id();
			//$e->sessao_id	=$this->id_sessao;

			$e->save();

			//adding limite value
			$e_limite=Limite::find($e->limite_id);
			foreach ($success_limite as $key => $value) {
				$e_limite->$key 	=$value;
				$success[$key]		=$value;
			}

			$e_limite->sessao_id	=$fake->sessao_id();
			//$e_limite->sessao_id	=$this->id_sessao;

			$e_limite->dthr_cadastro=date('Y-m-d H:i:s');

			$e_limite->save();

			$res=$d->responsedata(
				'convenio',
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
				'convenio',
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
	public function destroy($empresa_id,$id)
	{
		$d=new EmpresaConvenioData;
	}


}
