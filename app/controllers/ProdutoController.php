<?php

class produtodata extends StandardResponse{
	/** 
	* function name: header.
	* @param header with headers of produto table
	*/
	public function header(){
		/*
		$enderecoheader= headers on table enderecos
		In order to display or hide on HTML table, set as
		1 (visible) or 2 (not shown)
		*/
		$produtoheader=array(	
			array('nome',1)
			,array('descricao',1)
			,array('requisitos',1)
			,array('url_imagem',1)
			,array('url_video',1)
			,array('valor',1)
			,array('custo_extra',1)
			,array('servico',1)
			,array('limite',1)
			,array('status',1)
			,array('observacao',1)
			,array('perfil_id',1)
			,array('sessao_id',1)
			,array('dthr_cadastro',1)
			)
		;	
		return $produtoheader;
	}
	
	/**
	* @param edata retrieves all data from table "produto"
	*/
	public function edata () {
		return Produto::all();
	}

	public function show($id){
		return Produto::find($id);
	}

	public function activestatus () {
		return Produto::whereStatus(1)->get();
	}

	public function statusdeleted () {
		return Produto::whereStatus(0)->get();
	}

	/**
	* @param formdata returns array with form values
	*/
	public function formatdata(){

		return array(
			'nome'			=>Input::get('nome'),
			'descricao'		=>Input::get('descricao'),
			'requisitos'	=>Input::get('requisitos'),
			'url_imagem'	=>Input::get('url_imagem'),
			'url_video'		=>Input::get('url_video'),
			'valor'			=>Input::get('valor'),
			'custo_extra'	=>Input::get('custo_extra'),
			'servico'		=>Input::get('servico'),
			'limite'		=>Input::get('limite'),
			'status'		=>1,
			'observacao'	=>Input::get('observacao'),
			'perfil_id'		=>Input::get('perfil_id')
			)
		;
	}

	public function validrules(){
		return array(
			'nome'=>	'required'
					,'descricao'=>	'required'
					,'requisitos'=>	'required'
					,'url_imagem'=>	'required'
					,'url_video'=>	'required'
					,'valor'=>	'required'
					,'custo_extra'=>	'required'
					,'servico'=>	'required'
					,'limite'=>	'required'
					,'observacao'=>	'required'
					,'perfil_id'=>	'required'
			// ,'dthr_cadastro'=> timestamp, not required
			// ,'sessao_id'=> sessao, not required
			)
		;
	}
}


class ProdutoController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$d=new produtodata;
		$data=array(
			'header'=>$d->header(),
			'produto'=>$d->activestatus(),
			'deleted'=>$d->statusdeleted()
			)
		;
		return View::make('tempviews.produto.index',$data);

	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('tempviews.produto.create');

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

		$d=new produtodata;
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

			$e=new Produto;	
			foreach ($success as $key => $value) {
				$e->$key 	=$value;
			}

			$e->sessao_id	= $fake->sessao_id();
			//$e->sessao_id		=$this->id_sessao;
			$e->dthr_cadastro	=date('Y-m-d H:i:s');

			$e->save();

			$res=$d->responsedata(
				'Produto',
				true,
				'store',
				$success
				)
			;
			$code=200;


		} catch (Exception $e){
			SysAdminHelper::NotifyError($e->getMessage());
			$res=$d->responsedata(
				'Produto',
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
		$d=new produtodata;
		$data=array(
			'header'=>$d->header(),
			'produto'=>$d->show($id),
			'id'=>$id
			)
		;
		return View::make('tempviews.produto.show',$data);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$d=new produtodata;
		$data=array(
			'header'=>$d->header(),
			'produto'=>$d->show($id),
			'id'=>$id
			)
		;
		return View::make('tempviews.produto.edit',$data);
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

		$d=new produtodata;
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

			$e=Produto::find($id);	
			foreach ($success as $key => $value) {
				$e->$key 	=$value;
			}
			$e->sessao_id		=$fake->sessao_id();
			//$e->sessao_id	=$this->id_sessao;
			$e->dthr_cadastro	=date('Y-m-d H:i:s');
			$e->save();	

			//response structure required for angularjs
			$res=$d->responsedata(
				'Produto',
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
				'Compras',
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
		$d=new comprasdata;
		try{
			$e=Produto::find($id);

			//Register is considered as "deleted" when status=0;
			$e->status=0;
			$e->save();
			//
			$res=$d->responsedata(
				'Produto',
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
				'Compras',
				false,
				'delete',
				array('msg' => json_decode($e->getMessage()))
				)
			;
			$code=400;

		}
		return Response::json($res,$code);
	}


}
