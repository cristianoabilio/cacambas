<?php

class planodata{

	/** 
	* function name: header.
	* @param header with headers of "plano" table
	*/
	public function header(){
		$planodata=array(	
			array('IDLimite',0)
			,array('nome',1)
			,array('descricao',1)
			,array('valor_total',1)
			,array('percentual_desconto',0)
			,array('valor_desconto',0)
			,array('status',0)
			,array('validade_meses',0)
			,array('valiade_dias',0)
			,array('disponivel',0)
			,array('IDSessao',0)
			,array('dthr_cadastro',0)
			)
		;
		return $planodata;
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
		

}

class PlanoController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$d=new planodata;
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
		try{
			$validator= Validator::make(		
				Input::All(),	
				array(
					'IDLimite'=>				'required'
					,'nome'=>					'required'
					,'descricao'=>				'required'
					,'valor_total'=>			'required'
					,'disponivel'=>				'required'
					,'IDSessao'=>				'required'
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

			$e=new Plano;	
			$e->IDLimite			=Input::get('IDLimite');
			$e->nome				=Input::get('nome');
			$e->descricao			=Input::get('descricao');
			$e->valor_total			=Input::get('valor_total');
			$e->percentual_desconto	=Input::get('percentual_desconto');
			$e->valor_desconto		=Input::get('valor_desconto');
			$e->status				=1;
			$e->validade_meses		=Input::get('validade_meses');
			$e->valiade_dias		=Input::get('valiade_dias');
			$e->disponivel			=Input::get('disponivel');
			$e->IDSessao			=Input::get('IDSessao');
			$e->dthr_cadastro		=date('Y-m-d H:i:s');
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
		$d=new planodata;
		$data=array(

			'header'=>$d->header(),

			'plano'=>$d->show($id),

			'id' 		=>$id
			
			)
		;

		return View::make('tempviews.plano.show',$data);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$d=new planodata;
		$data=array(

			'header'=>$d->header(),

			'plano'=>$d->show($id),

			'id' 		=>$id
			
			)
		;

		return View::make('tempviews.plano.edit',$data);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		try{
			$validator= Validator::make(			
				Input::All(),	
				array(
					'IDLimite'=>				'required'
					,'nome'=>					'required'
					,'descricao'=>				'required'
					,'valor_total'=>			'required'
					,'disponivel'=>				'required'
					,'IDSessao'=>				'required'
					,'dthr_cadastro'=>			'required'
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

			$e=Plano::find($id);	
			$e->IDLimite			=Input::get('IDLimite');
			$e->nome				=Input::get('nome');
			$e->descricao			=Input::get('descricao');
			$e->valor_total			=Input::get('valor_total');
			$e->percentual_desconto	=Input::get('percentual_desconto');
			$e->valor_desconto		=Input::get('valor_desconto');
			$e->status				=1;
			$e->validade_meses		=Input::get('validade_meses');
			$e->valiade_dias		=Input::get('valiade_dias');
			$e->disponivel			=Input::get('disponivel');
			$e->IDSessao			=Input::get('IDSessao');
			$e->dthr_cadastro		=date('Y-m-d H:i:s');
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
			$e=Plano::find($id);

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
