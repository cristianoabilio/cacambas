<?php

class PlanoData extends StandardResponse{

	/** 
	* function name: header.
	* @param header with headers of "plano" table
	*/
	public function header(){
		$header=array(	
			array('nome',1)
			,array('descricao',1)
			,array('valor_total',1)
			,array('percentual_desconto',0)
			,array('valor_desconto',0)
			,array('status',0)
			,array('validade_meses',0)
			,array('valiade_dias',0)
			,array('disponivel',0)
			,array('sessao_id',0)
			,array('dthr_cadastro',0)
			)
		;
		return $header;
	}

	public function limiteheader(){
		/*
		$enderecoheader= headers on table enderecos
		In order to display or hide on HTML table, set as
		1 (visible) or 2 (not shown)
		*/
		$header=array(	
			array('motoristas',1)
			,array('caminhoes',1)
			,array('rastreamento',0)
			,array('cacambas',0)
			,array('NFSe',0)
			,array('manutencao',0)
			,array('pagamentos',0)
			,array('fluxo_caixa',0)
			,array('relatorio_avancado',0)
			,array('benchmarks',0)
			,array('sessao_id',0)
			,array('dthr_cadastro',0)

			)
		;	
		return $header;
	}

	/**
	* @param edata retrieves all data from table "plano"
	*/
	public function edata () {
		return Plano::all();
	}

	public function statusactive(){
		return Plano::whereStatus(1)->get();
	}

	public function statusfalse(){
		return Plano::whereStatus(0)->get();
	}


	/**
	* @param "show" retrieves register with primary key "$id" 
	*         from table "plano".
	*/
	public function show($id){
		return Plano::find($id);
	}

	/**
	* @param formdata returns array with form values
	*/
	public function formatdata(){

		$formdata=array(
			'nome'					=>Input::get('nome'),
			'valor_total'			=>Input::get('valor_total'),
			'status'				=>1,
			'disponivel'			=>Input::get('disponivel')
			)
		;

		$nullable=array(
			'descricao'				=>Input::get('descricao'),
			'percentual_desconto'	=>Input::get('percentual_desconto'),
			'validade_meses'		=>Input::get('validade_meses'),
			'valiade_dias'			=>Input::get('valiade_dias')
			)
		;

		foreach ($nullable as $k => $v) {
			if ( trim($v)!='')
			{
				$formdata[$k]=$v;
			}
		}

		
		return $formdata;
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
			'nome'					=>	'required'
			,'valor_total'			=>	'required'
			,'disponivel'			=>	'required'
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

class PlanoController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$d=new PlanoData;

		$data=array(

			'header'=>$d->header(),

			'plano'=>$d->statusactive(),

			'deleted'=>$d->statusfalse()
			
			)
		;
		return View::make('tempviews.plano.index',$data);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return
		View::make(
			'tempviews.plano.create'

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

		$d=new PlanoData;
		$success=$d->formatdata();

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

			$e=new Plano;	
			foreach ($success as $key => $value) {
				$e->$key 	=$value;
			}
			$e->sessao_id			=$fake->sessao_id();
			//$e->sessao_id	=$this->id_sessao;
			$e->dthr_cadastro		=date('Y-m-d H:i:s');
			$e->save();

			$success['id']=$e->id;

			$e_limite=new Limite;
			foreach ($success_limite as $key => $value) {
				$e_limite->$key 	=$value;
				$success[$key]		=$value;
			}
			$e_limite->plano_id=$e->id;
			$e_limite->sessao_id	=$fake->sessao_id();
			//$e_limite->sessao_id	=$this->id_sessao;

			$e_limite->dthr_cadastro=date('Y-m-d H:i:s');
			$e_limite->save();
			$success['idlimit']=$e_limite->id;

			$res=$d->responsedata(
				'plano',
				true,
				'store',
				$success
				)
			;
			$code=200;


		} catch (Exception $e){
			SysAdminHelper::NotifyError($e->getMessage());
			$res=$d->responsedata(
				'plano',
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
		$d=new PlanoData;
		try {
			if (Plano::whereId($id)->whereStatus(1)->count()==0) {
				$res=$d->responsedata(
					'plano',
					false,
					'show',
					$d->noexist
					)
				;
				$res=json_encode($res);
				throw new Exception($res);
			}
			$data=array(
				'header'=>$d->header(),
				'limiteheader'=>$d->limiteheader(),
				'plano'=>$d->show($id),
				'id' 		=>$id
				)
			;
			return View::make('tempviews.plano.show',$data);
			
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
		$d=new PlanoData;
		try {
			if (Plano::whereId($id)->whereStatus(1)->count()==0) {
				$res=$d->responsedata(
					'plano',
					false,
					'edit',
					$d->noexist
					)
				;
				$res=json_encode($res);
				throw new Exception($res);
			}
			$data=array(
				'header'=>$d->header(),
				'plano'=>$d->show($id),
				'id' 		=>$id
				)
			;
			return View::make('tempviews.plano.edit',$data);
			
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

		$d=new PlanoData;
		$success=$d->formatdata();
		$success_limite=$d->formatDataFromLimite();
		//
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

			$e=Plano::find($id);	
			foreach ($success as $key => $value) {
				$e->$key 	=$value;
			}
			$e->sessao_id			=$fake->sessao_id();
			//$e->sessao_id	=$this->id_sessao;
			$e->dthr_cadastro		=date('Y-m-d H:i:s');
			$e->save();	

			$e_limite=Limite::find($e->limite->id);
			foreach ($success_limite as $key => $value) {
				$e_limite->$key 	=$value;
				$success[$key]		=$value;
			}
			$e_limite->sessao_id	=$fake->sessao_id();
			//$e_limite->sessao_id	=$this->id_sessao;
			$e_limite->dthr_cadastro=date('Y-m-d H:i:s');
			$e_limite->save();
			$res=$d->responsedata(
				'plano',
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
				'plano',
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
	public function destroy($id)
	{
		$d=new PlanoData;
		try{
			if (Plano::whereId($id)->whereStatus(1)->count()==0) {
				throw new Exception(json_encode($d->noexist));
			}
			$e=Plano::find($id);

			//Register is considered as "deleted" when status=0;
			$e->status=0;
			$e->save();
			//
			$res=$d->responsedata(
				'plano',
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
				'plano',
				false,
				'delete',
				array('msg' => json_decode($e->getMessage()))
				)
			;
			$code=400;

		}
		return Response::json($res);
	}
}
