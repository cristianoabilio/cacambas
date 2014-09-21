<?php

class produtodata{
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
			,array('IDPerfil',1)
			,array('sessao_id',1)
			,array('dthr_cadastro',1)
			)
		;	
		return $produtoheader;
	}
	
	/**
	* @param edata retrieves all data from table "limite"
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
		$fake=new fake;
		//
		try{
			$validator= Validator::make(		
				Input::All(),	
				array(
					'nome'=>	'required'
					,'descricao'=>	'required'
					,'requisitos'=>	'required'
					,'url_imagem'=>	'required'
					,'url_video'=>	'required'
					,'valor'=>	'required'
					,'custo_extra'=>	'required'
					,'servico'=>	'required'
					,'limite'=>	'required'
					,'status'=>	'required'
					,'observacao'=>	'required'
					,'IDPerfil'=>	'required'
					),
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
			$e->nome	=Input::get('nome');
			$e->descricao	=Input::get('descricao');
			$e->requisitos	=Input::get('requisitos');
			$e->url_imagem	=Input::get('url_imagem');
			$e->url_video	=Input::get('url_video');
			$e->valor	=Input::get('valor');
			$e->custo_extra	=Input::get('custo_extra');
			$e->servico	=Input::get('servico');
			$e->limite	=Input::get('limite');
			$e->status	=Input::get('status');
			$e->observacao	=Input::get('observacao');
			$e->IDPerfil	=Input::get('IDPerfil');
			$e->sessao_id	=Input::get('sessao_id');
			$e->dthr_cadastro	=date('Y-m-d H:i:s');

			$e->save();

			$res=$res = array(
				'status'=>'success',
				'msg' => 'SUCCESFULLY SAVED!'
				)
			;


		} catch (Exception $e){
			SysAdminHelper::NotifyError($e->getMessage());
			$res = array('status'=>'error','msg' => json_decode($e->getMessage()));
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
		$fake=new fake;
		//
		try{
			$validator= Validator::make(			
				Input::All(),	
				array(
					'nome'=>	'required'
					,'descricao'=>	'required'
					,'requisitos'=>	'required'
					,'url_imagem'=>	'required'
					,'url_video'=>	'required'
					,'valor'=>	'required'
					,'custo_extra'=>	'required'
					,'servico'=>	'required'
					,'limite'=>	'required'
					,'status'=>	'required'
					,'observacao'=>	'required'
					,'IDPerfil'=>	'required'
					),	
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
			$e->nome	=Input::get('nome');
			$e->descricao	=Input::get('descricao');
			$e->requisitos	=Input::get('requisitos');
			$e->url_imagem	=Input::get('url_imagem');
			$e->url_video	=Input::get('url_video');
			$e->valor	=Input::get('valor');
			$e->custo_extra	=Input::get('custo_extra');
			$e->servico	=Input::get('servico');
			$e->limite	=Input::get('limite');
			$e->status	=Input::get('status');
			$e->observacao	=Input::get('observacao');
			$e->IDPerfil	=Input::get('IDPerfil');
			$e->sessao_id	=Input::get('sessao_id');
			$e->dthr_cadastro	=date('Y-m-d H:i:s');
			$e->save();	

			$res=$res = array(
				'status'=>'success',
				'msg' => 'SUCCESFULLY UPDATED!'
				)
			;
		}
		catch (Exception $e){
			SysAdminHelper::NotifyError($e->getMessage());
			$res = array('status'=>'error','msg' => json_decode($e->getMessage()));
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
		try{
			$e=Produto::find($id);

			//Register is considered as "deleted" when status=0;
			$e->status=0;
			$e->save();
			//
			$res = array('status'=>'success','msg' => 'Registro excluído com sucesso!');
		}
		catch(Exception $e){
			SysAdminHelper::NotifyError($e->getMessage());
			$res = array('status'=>'error','msg' => json_decode($e->getMessage()));
		}
		return Response::json($res);
	}


}
