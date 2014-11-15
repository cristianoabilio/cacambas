<?php

class EmpresaCustoData extends StandardResponse{
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
				//array('equipamento_id',1)
				//,array('caminhao_id',0)
				//,array('funcionario_id',0)
				//,array('dt_inicio',0)
				//,array('dt_fim',0)
				//,array('valor',0)
				//,array('status_financeiro',0)
				//,array('prestadora',0)
				//,array('detalhe',0)
				//,array('status_custo',0)
				//,array('classe_id',1)
				//,array('subclasse_id',0)
				//,array('sessao_id',1)
				//,array('dthr_cadastro',1)
			)
		;	
		return $header;
	}
	
	/**
	* @param edata retrieves all data from table "limite"
	*/
	public function edata ($empresa_id) {
		//return Custo::whereStatus_custo(1)->get();
		return  Empresa::find($empresa_id)->custo;
		//Custo::all();
		//Custo::all();
		//return Custo::whereEmpresa_id($empresa_id)->active()->get();
	}

	public function edatainactive ($empresa_id) {
		//return Custo::whereStatus_custo(0)->get();
		//return array(1);//Custo::whereEmpresa_id($empresa_id)->Noactive()->get();
		return Custo::all();
	}

	public function show($id){
		return Custo::find($id);
	}

	/**
	* @param formdata returns array with form values
	*/
	public function form_data(){
		$fillable=array(
			'dt_inicio'		
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
		return $this->formCapture ($fillable,$nullable);

	}

	public function validrules(){
		return array(
			//'empresa_id'		=>'required',
			'dt_inicio'			=>'required',
			'dt_fim'			=>'required',
			'valor'				=>'required',
			'status_financeiro'	=>'required',
			'classe_id'			=>'required',
			'subclasse_id'		=>'required'
			//
			//rules for convenio
			//
			)
		;
	}
}

class EmpresaCustoController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($empresa_id)
	{
		$d=new EmpresaCustoData;
		return $d->edata($empresa_id);

	}

	public function visible ($empresa_id) {
		$d=new EmpresaCustoData;

		$data=array(
			'header' 	=> $d->header(),
			'custo'	=> $d->edata($empresa_id),
			'deleted'=>$d->edatainactive($empresa_id),
			'empresa'=>Empresa::find($empresa_id),
			'empresa_id'=>$empresa_id
			)
		;
		return View::make('tempviews.EmpresaCusto.index',$data);

	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($empresa_id)
	{
		$data=array(
			'empresa'=>Empresa::find($empresa_id),
			'empresa_id'=>$empresa_id
			)
		;
		return View::make('tempviews.EmpresaCusto.create',$data);

	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($empresa_id)
	{
		//instantiate fake user (for empresa and sessao)
		//SHOULD BE DELETED IN ORIGINAL PROJECT
		$fake=new fakeuser;
		//
		//
		$d=new EmpresaCustoData;
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
			$e->empresa_id=$empresa_id;
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
	public function show($empresa_id,$id)
	{
		$d=new EmpresaCustoData;
		return $d->show($id);
	}

	public function showvisible($empresa_id,$id)
	{
		$d=new EmpresaCustoData;
		$data=array();
		//return View::make('tempviews.EmpresaCusto.show',$data);
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
				'custo'		=>$d->show($id),
				'header'	=>$d->header(),
				'empresa_id'=>$empresa_id,
				'id'		=>$id
				)
			;
			return View::make('tempviews.EmpresaCusto.show',$data);
			
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
	public function edit($empresa_id,$id)
	{
		$d=new EmpresaCustoData;
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
				'empresa_id'=>$empresa_id,
				'id'			=>$id
				)
			;
			return View::make('tempviews.EmpresaCusto.edit',$data);
			
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
	public function update($empresa_id,$id)
	{
		//instantiate fake user (for empresa and sessao)
		//SHOULD BE DELETED IN ORIGINAL PROJECT
		$fake=new fakeuser;
		//
		//
		$d=new EmpresaCustoData;
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
	public function destroy($empresa_id,$id)
	{
		$d=new EmpresaCustoData;
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

	public function reactivate($empresa_id,$id)
	{
		$d=new EmpresaCustoData;
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
