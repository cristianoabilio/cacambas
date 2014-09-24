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

		return array(
			'nome'				=>Input::get('nome'),
			'descricao'			=>Input::get('descricao'),
			'valor_total'			=>Input::get('valor_total'),
			'percentual_desconto'	=>Input::get('percentual_desconto'),
			'valor_desconto'		=>Input::get('valor_desconto'),
			'status'				=>1,
			'validade_meses'		=>Input::get('validade_meses'),
			'valiade_dias'		=>Input::get('valiade_dias'),
			'disponivel'			=>Input::get('disponivel')
				)
		;
	}

	public function validrules(){
		return array(
			'nome'			=>'required'
			//,'descricao'	=>'required'
			,'valor_total'	=>'required'
			,'disponivel'	=>'required'
			// ,'dthr_cadastro'=> timestamp, not required
			// ,'sessao_id'=> sessao, not required
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
