<?php

/**
 * empresadata class only contains data related to
 * the table Empresa
 */
class empresadata extends StandardResponse{
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
			array('nome',1)
			,array('nome_fantasia',1)
			,array('cnpj',0)
			,array('insc_estadual',0)
			,array('responsavel',0)
			,array('email',0)
			,array('telefone',0)
			,array('celular',0)
			,array('observacao',0)
			,array('afiliado',0)
			,array('status',0)
		);	
		return $header;
	}
	
	/**
	* @param edata retrieves all data from table "empresa"
	*/
	public function edata () {
		return Empresa::all();
	}

	public function show($id){
		return Empresa::find($id)->first();
	}

	/**
	* @param formdata returns array with form values
	*/
	public function formdata(){

		return array(
				'nome'			=>Input::get('nome'),
				'nome_fantasia'	=>Input::get('nome_fantasia'),
				'cnpj'			=>Input::get('cnpj'),
				'insc_estadual'	=>Input::get('insc_estadual'),
				'responsavel'	=>Input::get('responsavel'),
				'email'			=>Input::get('email'),
				'telefone'		=>Input::get('telefone'),
				'celular'		=>Input::get('celular'),
				'observacao'	=>Input::get('observacao'),
				'afiliado'		=>Input::get('afiliado')
				)
		;
	}

	public function validrules(){
		return array(
			'nome'=>			'required'
			,'nome_fantasia'=>	'required'
			,'cnpj'=>			'required'
			,'insc_estadual'=>	'required'
			,'responsavel'=>	'required'
			,'email'=>			'required'
			,'telefone'=>		'required'
			,'celular'=>		'required'
			,'observacao'=>		'required'
			,'afiliado'=>		'required'
			)
		;
	}

}

class EmpresaController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$h=new empresadata;
		
		$data=array(
			//retrieving all "Empresas" 
			'empresas'=>Empresa::whereStatus(1)->get(),

			//deleted "Empresas" (status =0 )
			'deleted'=>Empresa::whereStatus(0)->get(),

			//retrieving table headers
			'header'=>$h->header()
			)
		;

		//displaying index view
		return 
		View::make(
			'tempviews.empresa.index',
			$data
			)
		;
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
			'tempviews.empresa.create'
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

		$d=new empresadata;
		$success=$d->formdata();

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

			$e=new Empresa;	
			foreach ($success as $key => $value) {
				$e->$key 	=$value;
			}
			//default status when Empresa is created=1
			$e->status			=1;

			//timestamp
			$e->dthr_cadastro	=date('Y-m-d H:i:s');

			$e->sessao_id		=$fake->sessao_id();
			//$e->sessao_id		=$this->id_sessao;
			
			$e->save();	

			$res=$d->responsedata(
				'Empresa',
				true,
				'store',
				$success
				)
			;
			$code=200;
		}
		catch (Exception $e){
			SysAdminHelper::NotifyError($e->getMessage());
			$res=$d->responsedata(
				'Empresa',
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
		$h=new empresadata;
		$data=array(
			'empresa'=>$h->show($id),
			'header'=>$h->header(),
			'id'=>$id
			)
		;
		return View::make('tempviews.empresa.show',$data);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$h=new empresadata;
		$data=array(
			'empresa'=>$h->show($id),
			'header'=>$h->header(),
			'id'=>$id
			)
		;
		return View::make('tempviews.empresa.edit',$data);
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

		$d=new empresadata;
		$success=$d->formdata();

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

			$e=Empresa::find($id);
			foreach ($success as $key => $value) {
				$e->$key 	=$value;
			}
			$e->status			=1;
			$e->dthr_cadastro	=date('Y-m-d H:i:s');
			$e->sessao_id		=$fake->sessao_id();
			//$e->sessao_id	=$this->id_sessao;
			$e->save();	

			//response structure required for angularjs
			$res=$d->responsedata(
				'Empresa',
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
				'Empresa',
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
		$d=new empresadata;
		try{

			$e=Empresa::find($id);
			$e->status=0;
			$e->save();	

			$res=$d->responsedata(
				'Empresa',
				true,
				'delete',
				array('msg' => 'Registro excluído com sucesso!')
				)
			;
			$code=200;

		}catch(Exception $e){

			SysAdminHelper::NotifyError($e->getMessage());

			$res=$d->responsedata(
				'Empresa',
				true,
				'delete',
				array('msg' => json_decode($e->getMessage()))
				)
			;
			$code=400;

		}

		return Response::json($res);
	}

}
