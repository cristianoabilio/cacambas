<?php

class LimiteData extends StandardResponse{
	/** 
	* function name: header.
	* @param header with headers of limite table
	*/
	public function header(){
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
	* @param edata retrieves all data from table "limite"
	*/
	public function edata () {
		return Limite::all();
	}

	public function show($id){
		return Limite::find($id);
	}

	/**
	* @param formdata returns array with form values
	*/
	public function formatdata(){

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
			'motoristas'	=>	'required|integer'
			,'caminhoes'	=>	'required|integer'
			,'rastreamento'	=>	'required|integer'
			,'cacambas'		=>	'required|integer'
			,'NFSe'			=>	'required|integer'
			,'manutencao'	=>	'required|boolean'
			,'pagamentos'	=>	'required|boolean'
			,'fluxo_caixa'	=>	'required|boolean'
			,'relatorio_avancado'=>	'required|boolean'
			,'benchmarks'	=>	'required|boolean'
			// ,'dthr_cadastro'=> timestamp, not required
			// ,'sessao_id'=> sessao, not required
			)
		;
	}
}

class LimiteController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$d=new LimiteData;
		$data=array(
			//retrieve all "limite" rows
			'limite'=>$d->edata(),

			//retrieving table headers
			'header'=>$d->header()
			)
		;
		return View::make('tempviews.limite.index',$data);
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
			'tempviews.limite.create'
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

		$d=new LimiteData;
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

			$e=new Limite;	
			foreach ($success as $key => $value) {
				$e->$key 	=$value;
			}
			$e->sessao_id			=$fake->sessao_id();
			//$e->sessao_id	=$this->id_sessao;
			$e->dthr_cadastro		=date('Y-m-d H:i:s');
			$e->save();

			$success['id']=$e->id;


			$res=$d->responsedata(
				'limite',
				true,
				'store',
				$success
				)
			;
			$code=200;


		} catch (Exception $e){
			SysAdminHelper::NotifyError($e->getMessage());
			$res=$d->responsedata(
				'limite',
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
		$d=new LimiteData;
		$data=array(
			'limite' 	=>$d->show($id),
			'header' 	=>$d->header(),
			'id' 		=>$id
			)
		;
		return View::make('tempviews.limite.show',$data);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$d=new LimiteData;
		$data=array(
			'limite' 	=>$d->show($id),
			'header' 	=>$d->header(),
			'id' 		=>$id
			)
		;
		return View::make('tempviews.limite.edit',$data);
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

		$d=new LimiteData;
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

			$e=Limite::find($id);	
			foreach ($success as $key => $value) {
				$e->$key 	=$value;
			}
			$e->sessao_id			=$fake->sessao_id();
			//$e->sessao_id	=$this->id_sessao;
			$e->dthr_cadastro		=date('Y-m-d H:i:s');
			$e->save();	

			$res=$d->responsedata(
				'limite',
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
				'limite',
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
		$d=new LimiteData;

		try{
			if (Limite::whereId($id)->count()==0) {
				throw new Exception(json_encode($d->noexist));
				$code=400;
			}

			Limite::whereId($id)->delete();
			$res=$d->responsedata(
				'limite',
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
				'limite',
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
