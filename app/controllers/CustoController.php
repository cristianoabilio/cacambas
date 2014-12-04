<?php

class CustoData extends StandardResponse{
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
				array('empresa_id',1)
				,array('equipamento_id',1)
				,array('caminhao_id',0)
				,array('funcionario_id',0)
				,array('dt_inicio',0)
				,array('dt_fim',0)
				,array('valor',0)
				,array('status_financeiro',0)
				,array('prestadora',0)
				,array('detalhe',0)
				//,array('status_custo',0)
				//,array('classe_id',1)
				,array('subclasse_id',0)
				//,array('sessao_id',1)
				//,array('dthr_cadastro',1)
			)
		;	
		return $header;
	}
	
	/**
	* @param edata retrieves all data from table "limite"
	*/
	public function edata () {
		return Custo::whereStatus_custo(1)->get();
	}

	public function edatainactive () {
		return Custo::whereStatus_custo(0)->get();
	}

	public function show($id){
		return Custo::find($id);
	}

	/**
	* @param formdata returns array with form values
	*/
	public function form_data(){
		$fillable=array(
			'empresa_id'		
			,'dt_inicio'		
			,'dt_fim'			
			,'valor'			
			,'status_financeiro'
			,'classe_id'		
			,'subclasse_id'	
			)
		;
		$nullable=array(
			'equipamento_id'	
			,'caminhao_id'		
			,'funcionario_id'	
			,'prestadora'		
			,'detalhe'			
			)
		;
		/**
		* formCapture method converts fillable items in
		* array 'item_1' => Input::get('item_1'),
		*       'item_n' => Input::get('item_n') 
		* and if Input::get('nullable') is not empty
		* nullable item is added inside the array
		* @return array
		*
		*/
		return $this->formCapture ($fillable,$nullable);

	}

	public function validrules(){
		return array(
			'empresa_id'		=>'required'
			//
			//rules for convenio
			//
			)
		;
	}
}

class CustoController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$d=new CustoData;
		return $d->edata();

	}

	public function visible () {
		$d=new CustoData;

		$data=array(
			'header' 	=> $d->header(),
			'custo'	=> $d->edata(),
			'deleted'=>$d->edatainactive()
			)
		;
		return View::make('tempviews.custo.index',$data);

	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$data=array();
		return View::make('tempviews.custo.create',$data);

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
		//
		$d=new CustoData;
		//
		$success=$d->form_data();
		//return $success;
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

			$e=new Custo;
			foreach ($success as $key => $value) {
				$e->$key 	=$value;
			}
			$e->status_custo=1;
			$e->sessao_id=$fake->sessao_id();
			$e->dthr_cadastro=date('Y-m-d H:i:s');
			$e->save();

			$success['id']=$e->id;

			$res=$d->responsedata(
				'custo',
				true,
				'store',
				$success
				)
			;
			$code=200;
		}
		catch(Exception $e) {
			SysAdminHelper::NotifyError($e->getMessage());
			$res=$d->responsedata(
				'custo',
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
		$d=new CustoData;
		return $d->show($id);
	}

	public function showvisible($id)
	{
		$d=new CustoData;
		$data=array();
		//return View::make('tempviews.custo.show',$data);
		try {
			if (Custo::whereId($id)->count()==0) {
				$res=$d->responsedata(
					'custo',
					false,
					'show',
					$d->noexist
					)
				;
				$res=json_encode($res);
				throw new Exception($res);
			}
			$data=array(
				'custo'	=>$d->show($id),
				'header'		=>$d->header(),
				'id'			=>$id
				)
			;
			return View::make('tempviews.custo.show',$data);
			
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
		$d=new CustoData;
		$data=array();
		try {
			if (Custo::whereId($id)->count()==0) {
				$res=$d->responsedata(
					'custo',
					false,
					'edit',
					$d->noexist
					)
				;
				$res=json_encode($res);
				throw new Exception($res);
			}
			$data=array(
				'custo'	=>$d->show($id),
				'header'		=>$d->header(),
				'id'			=>$id
				)
			;
			return View::make('tempviews.custo.edit',$data);
			
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
		//
		$d=new CustoData;
		//
		$success=$d->form_data();
		//return $success;
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

			$e=Custo::find($id);
			foreach ($success as $key => $value) {
				$e->$key 	=$value;
			}
			$e->status_custo=1;
			$e->sessao_id=$fake->sessao_id();
			$e->dthr_cadastro=date('Y-m-d H:i:s');
			$e->save();

			//

			$res=$d->responsedata(
				'custo',
				true,
				'update',
				$success
				)
			;
			$code=200;
		}
		catch(Exception $e) {
			SysAdminHelper::NotifyError($e->getMessage());
			$res=$d->responsedata(
				'custo',
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
		$d=new CustoData;
		try{
			if (Custo::whereId($id)->count()==0) {
				throw new Exception(json_encode($d->noexist));
			}
			$e=Custo::find($id);
			$e->status_custo=0;
			$e->save();

			$res=$d->responsedata(
				'custo',
				true,
				'delete',
				array('msg' => 'Resource was softdeleted')
				)
			;
			$code=200;

		}catch(Exception $e){

			SysAdminHelper::NotifyError($e->getMessage());

			$res=$d->responsedata(
				'custo',
				false,
				'delete',
				array('msg' => json_decode($e->getMessage()))
				)
			;
			$code=400;

		}

		return Response::json($res,$code);
	}

	public function reactivate($id)
	{
		$d=new CustoData;
		try{
			if (Custo::whereId($id)->count()==0) {
				throw new Exception(json_encode($d->noexist));
			}
			$e=Custo::find($id);
			$e->status_custo=1;
			$e->save();

			$res=$d->responsedata(
				'custo',
				true,
				'delete',
				array('msg' => 'Resource was restored!')
				)
			;
			$code=200;

		}catch(Exception $e){

			SysAdminHelper::NotifyError($e->getMessage());

			$res=$d->responsedata(
				'custo',
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
