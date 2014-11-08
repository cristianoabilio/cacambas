<?php
/**
 * [Table]Data class only contains data related to
 * the table 
 */
class CaminhaoData extends StandardResponse{
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
			array('empresa_id',1)
			,array('placa',1)
			,array('renavan',0)
			,array('marca',0)
			,array('modelo',0)
			,array('apelido',0)
			//,array('status',0)
			,array('gps',0)
			)
		;	
		return $header;
	}
	
	/**
	* @param edata retrieves all data from table "empresa"
	*/
	public function edata () {
		return Caminhao::whereStatus(1)->get();
	}

	/**
	* @param edata retrieves all data from table "empresa"
	*/
	public function edatadeleted () {
		return Caminhao::whereStatus(0)->get();
	}

	public function show($id){
		return Caminhao::find($id);
	}

	/**
	* @param formdata returns array with form values
	*/
	public function form_data(){
		$fillable=array(
			'empresa_id',
			'marca',
			'modelo',
			'placa'
			)
		;
		//
		$nullable=array(
			'renavan',
			'apelido',
			'gps'
			)
		;
		return $this->formCapture ($fillable,$nullable);
	}

	public function validrules(){
		return array(
			'marca'		=>	'required'
			,'modelo'	=>	'required'
			,'placa'	=>	'required'
			)
		;
	}

}

class Caminhao2Controller extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$d=new CaminhaoData;
		return $d->edata();
	}

	public function visible () {
		$d=new CaminhaoData;
		$data=array(
			//all caminhao
			'caminhao'=>$d->edata(),
			'header'=>$d->header(),
			'caminhao_0'=>$d->edatadeleted()
			)
		;
		return View::make('tempviews.caminhao2.index',$data);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$data=array();
		return View::make('tempviews.caminhao2.create',$data);
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

		$d=new CaminhaoData;

		$success=$d->form_data();

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

			$e=new Caminhao;	
			foreach ($success as $key => $value) {
				$e->$key 	=$value;
			}
			$e->status=1;
			$e->dthr_cadastro=date('Y-m-d');

			$e->sessao_id		=$fake->sessao_id();
			//$e->sessao_id		=$this->id_sessao;
			$e->save();

			$success['id']=$e->id;

			$res=$d->responsedata(
				'caminhao',
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
				'caminhao',
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
		$d=new CaminhaoData;
		return $d->show($id);
	}

	public function showvisible($id) {
		$d=new CaminhaoData;

		try {
			if (Caminhao::whereId($id)->count()==0) {
				$res=$d->responsedata(
					'caminhao',
					false,
					'show',
					$d->noexist
					)
				;
				$res=json_encode($res);
				throw new Exception($res);
			}
			$data=array(
				'caminhao'	=>$d->show($id),
				'header'	=>$d->header(),
				'id'		=>$id
				)
			;
			return View::make('tempviews.caminhao2.show',$data);

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
		$d=new CaminhaoData;
		try {
			if (Caminhao::whereId($id)->count()==0) {
				$res=$d->responsedata(
					'caminhao',
					false,
					'edit',
					$d->noexist
					)
				;
				$res=json_encode($res);
				throw new Exception($res);
			}
			$data=array(
				'caminhao'	=>$d->show($id),
				'header'	=>$d->header(),
				'id'		=>$id
				)
			;
			return View::make('tempviews.caminhao2.edit',$data);
			
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

		$d=new CaminhaoData;
		$success=$d->form_data();

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

			$e=Caminhao::find($id);
			foreach ($success as $key => $value) {
				$e->$key 	=$value;
			}
			$e->dthr_cadastro=date('Y-m-d');
			$e->sessao_id		=$fake->sessao_id();
			$e->save();	

			//response structure required for angularjs
			$res=$d->responsedata(
				'caminhao',
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
				'caminhao',
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
		$d=new CaminhaoData;

		try{
			if (Caminhao::whereId($id)->count()==0) {
				throw new Exception(json_encode($d->noexist));
				$code=400;
			}

			$c=Caminhao::find($id);
			$c->status=0;
			$c->save();
			//::whereId($id)->delete();
			$res=$d->responsedata(
				'caminhao',
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
				'caminhao',
				false,
				'delete',
				array('msg' => json_decode($e->getMessage()))
				)
			;
			$code=400;
		}

		return Response::json($res,$code);
	}

	public function reactivate ($id) {
		$d=new CaminhaoData;

		try{
			if (Caminhao::whereId($id)->count()==0) {
				throw new Exception(json_encode($d->noexist));
				$code=400;
			}

			$c=Caminhao::find($id);
			$c->status=1;
			$c->save();

			$res=$d->responsedata(
				'caminhao',
				true,
				'restore',
				array('msg' => 'Restored resource')
				)
			;
			$code=200;

		}
		catch(Exception $e){
			SysAdminHelper::NotifyError($e->getMessage());
			$res=$d->responsedata(
				'caminhao',
				false,
				'restore',
				array('msg' => json_decode($e->getMessage()))
				)
			;
			$code=400;
		}

		return Response::json($res,$code);
	}




}
