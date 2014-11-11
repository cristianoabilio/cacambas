<?php
class ConvenioData extends StandardResponse{
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
	public function edata () {
		return Convenio::all();
	}

	public function show($id){
		return Convenio::find($id);
	}

	/**
	* @param formdata returns array with form values
	*/
	public function form_data(){

		return array(
			'plano_id'			=>Input::get('plano_id'),
			'dia_fatura'		=>Input::get('dia_fatura'),
			'tipo_pagamento'	=>Input::get('tipo_pagamento'),
			'dt_inicio'			=>Input::get('dt_inicio'),
			'dt_fim'			=>Input::get('dt_fim')
			)
		;
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
		return array(
			//
			//rules for convenio
			'plano_id'=>		'required|integer'
			,'tipo_pagamento'=>	'required|integer'
			,'dt_inicio'=>		'required|date'
			//
			//
			//rules for limite
			,'motoristas'			=>	'required|integer'
			,'caminhoes'			=>	'required|integer'
			,'rastreamento'			=>	'required|integer'
			,'cacambas'				=>	'required|integer'
			,'NFSe'					=>	'required|integer'
			,'manutencao'			=>	'required|boolean'
			,'pagamentos'			=>	'required|boolean'
			,'fluxo_caixa'			=>	'required|boolean'
			,'relatorio_avancado'	=>	'required|boolean'
			,'benchmarks'			=>	'required|boolean'
			)
		;
	}
}

class ConvenioController extends \BaseController {

	public function __construct(){
		////$this->beforeFilter('csrf', array('on' => 'post'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index () {
		$d=new ConvenioData;
		return Response::json($d->edata());
	}


	/**
	* Visible action IS NOT A RESTFUL RESOURCE 
	* but is required for generating the view
	* with access links to each resource,
	* this is, the visible index page.
	* The reason of this method is because the
	* index resource will throw a JSON object
	* and no view at all.
	*/
	public function visible()
	{
		$d=new ConvenioData;

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
		$d=new ConvenioData;
		$limite_h=$d->limiteHeader();
		return 
		View::make(
			'tempviews.convenio.create',
			compact('limite_h')
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

		$d=new ConvenioData;

		$success= $d->form_data();

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
			$e_limite=new Limite;
			foreach ($success_limite as $key => $value) {
				$e_limite->$key 	=$value;
				$success[$key]		=$value;
			}
			$e_limite->sessao_id	=$fake->sessao_id();
			//$e_limite->sessao_id	=$this->id_sessao;

			$e_limite->dthr_cadastro=date('Y-m-d H:i:s');
			$e_limite->save();
			$success['idlimit']=$e_limite->id;

			$e=new Convenio;
			$e->limite_id=$success['idlimit'];
			$e->empresa_id		=$fake->empresa();
			foreach ($success_convenio as $key => $value) {
				$e->$key 	=$value;
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
	public function show ($id) {
		$d=new ConvenioData;
		return $d->show($id);
	}
	public function showvisible($id)
	{
		$d=new ConvenioData;
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

			return View::make('tempviews.convenio.show',
				compact(
					'convenio',
					'header',
					'limite',
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
	public function edit($id)
	{
		$d=new ConvenioData;
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
				'tempviews.convenio.edit',
				compact(
					'convenio',
					'header',
					'limiteheader',
					'limite',
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
	public function update($id)
	{
		//instantiate fake user (for empresa and sessao)
		//SHOULD BE DELETED IN ORIGINAL PROJECT
		$fake=new fakeuser;
		//
		$d=new ConvenioData;

		$success=			$d->form_data();

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
	/*public function destroy($id)
	{
		//
	}*/


}
