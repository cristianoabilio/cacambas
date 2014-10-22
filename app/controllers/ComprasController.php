<?php

/**
 * ComprasData class only contains data related to
 * the table Compras
 */
class ComprasData extends StandardResponse{
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
			array('produto_id',1)
			,array('convenio_id',1)
			,array('limite',1)
			,array('desconto_valor',1)
			,array('desconto_percentual',1)
			,array('ativado',1)
			,array('data_compra',1)
			,array('data_ativacao',1)
			,array('data_desativacao',1)
		);	
		return $header;
	}
	
	/**
	* @param edata retrieves all data from table "empresa"
	*/
	public function edata () {
		return Compras::all();
	}

	public function show($id){
		return Compras::find($id);
	}

	/**
	* @param formdata returns array with form values
	*/
	public function formatdata(){

		$formdata=array(
			'produto_id'			=>Input::get('produto_id'),
			'convenio_id'			=>Input::get('convenio_id'),
			'limite'				=>Input::get('limite'),
			'desconto_valor'		=>Input::get('desconto_valor'),
			'desconto_percentual'	=>Input::get('desconto_percentual'),
			'ativado'				=>Input::get('ativado')
			)
		;

		//data_ativacao | data_desativacao | data_compra can be null
		$nullable=array(
			'data_compra'			=>Input::get('data_compra'),
			'data_ativacao'			=>Input::get('data_ativacao'),
			'data_desativacao'		=>Input::get('data_desativacao')
			)
		;
		foreach ($nullable as $key => $value) {
			if ( trim($value)!="" ) {
				$formdata[$key]=$value;
			}
			else {
				$formdata[$key]=null;
			}
		}
		return $formdata;
	}

	public function validrules(){
		return array(
			'produto_id'		=>	'required'
			,'convenio_id'		=>	'required'
			//,'limite'			=>	'required'
			//,'desconto_valor'	=>	'required'
			//,'desconto_percentual'=>'required'
			,'ativado'			=>	'required'
			//,'data_compra'		=>	'required'
			//,'data_ativacao'	=>	'required'
			//,'data_desativacao'	=>	'required'
			// ,'dthr_cadastro'=> timestamp, not required
			// ,'sessao_id'=> sessao, not required
			)
		;
	}

}

class ComprasController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$d=new ComprasData;
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
	public function visible () {
		$d=new ComprasData;
		$data=array(
			//all compras
			'compras'=>$d->edata(),
			'header'=>$d->header()
			)
		;
		return View::make('tempviews.compras.index',$data);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$data=array();
		return View::make('tempviews.compras.create',$data);
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

		$d=new ComprasData;
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

			$e=new Compras;	
			foreach ($success as $key => $value) {
				$e->$key 	=$value;
			}

			//timestamp
			$e->dthr_cadastro	=date('Y-m-d H:i:s');

			$e->sessao_id		=$fake->sessao_id();
			//$e->sessao_id		=$this->id_sessao;
			
			$e->save();

			$success['id']=$e->id;

			$res=$d->responsedata(
				'compras',
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
				'compras',
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
		$d=new ComprasData;
		try {
			if (Compras::whereId($id)->count()==0) {
				$res=$d->responsedata(
					'compra',
					false,
					'show',
					$d->noexist
					)
				;
				$res=json_encode($res);
				throw new Exception($res);
			}
			$data=array(
				'compras'	=>$d->show($id),
				'header'	=>$d->header(),
				'id'		=>$id
				)
			;
			return View::make('tempviews.compras.show',$data);
			
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
		$d=new ComprasData;
		try {
			if (Compras::whereId($id)->count()==0) {
				$res=$d->responsedata(
					'compra',
					false,
					'edit',
					$d->noexist
					)
				;
				$res=json_encode($res);
				throw new Exception($res);
			}
			$data=array(
				'compras'	=>$d->show($id),
				'header'	=>$d->header(),
				'id'		=>$id
				)
			;
			return View::make('tempviews.compras.edit',$data);
			
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

		$d=new ComprasData;
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

			$e=Compras::find($id);
			foreach ($success as $key => $value) {
				$e->$key 	=$value;
			}

			$e->dthr_cadastro	=date('Y-m-d H:i:s');
			$e->sessao_id		=$fake->sessao_id();
			//$e->sessao_id	=$this->id_sessao;
			$e->save();	

			//response structure required for angularjs
			$res=$d->responsedata(
				'compras',
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
				'compras',
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
		$d=new ComprasData;
		try{
			if (Compras::whereId($id)->count()==0) {
				throw new Exception(json_encode($d->noexist));
			}
			$e=Compras::whereId($id)->delete();

			$res=$d->responsedata(
				'compras',
				true,
				'delete',
				array('msg' => 'Registro excluído com sucesso!')
				)
			;
			$code=200;

		}catch(Exception $e){

			SysAdminHelper::NotifyError($e->getMessage());

			$res=$d->responsedata(
				'compras',
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
