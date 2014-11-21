<?php

/**
 * [Table]Data class only contains data related to
 * the table 
 */
class EmpresaEquipamentoItemData extends StandardResponse{
	/** 
	* function name: header.
	* @param header with headers of empresa table
	*/
	public function header() {
		return array(
			array('codigo',1)
			,array('rfid',1)
			,array('qrcode',1)
			,array('gps',1)
			)
		;
	}

	public function edata ($equipamentodetail_id){
		return Equipamentodetail::find($equipamentodetail_id)->equipamentoitem;
	}

	public function show($id){
		return Equipamentoitem::find($id);
	}

	/**
	* @param formdata returns array with form values
	*/
	public function form_data(){
		$fillable=array(
			'codigo'
			)
		;
		//
		$nullable=array(
			'rfid',
			'qrcode',
			'gps'
			)
		;
		return $this->formCapture ($fillable,$nullable);
	}

	public function validrules(){
		return array(
			/*'nome'		=>	'required'
			,'detalhe'	=>	'required'*/
			)
		;
	}
}

class EmpresaEquipamentoItemController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($empresa_id,$equipamentodetail_id)
	{
		$d=new EmpresaEquipamentoItemData;
		return $d->edata($equipamentodetail_id);
	}

	public function visible ($empresa_id,$equipamentodetail_id) {
		$d=new EmpresaEquipamentoItemData;
		$header=$d->header();
		$item=$d->edata($equipamentodetail_id);
		$pivot_id=Equipamentodetail::find($equipamentodetail_id)
		->empresa_equipamento_id;
		$equipamento=EmpresaEquipamento::find($pivot_id)->equipamento;
		return View::make(
			'tempviews.EmpresaEquipamentoItem.index',
			compact(
				'empresa_id',
				'equipamentodetail_id',
				'header',
				'item',
				'equipamento'
				)
			)
		;

	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($empresa_id,$equipamentodetail_id)
	{
		$empresa=Empresa::find($empresa_id);
		$pivot_id=Equipamentodetail::find($equipamentodetail_id)
		->empresa_equipamento_id;
		$equipamento=EmpresaEquipamento::find($pivot_id)->equipamento;
		return View::make(
			'tempviews.EmpresaEquipamentoItem.create',
			compact(
				'empresa_id',
				'equipamentodetail_id',
				'empresa',
				'equipamento'
				)
			)
		;
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($empresa_id,$equipamentodetail_id)
	{
		//instantiate fake user (for empresa and sessao)
		//SHOULD BE DELETED IN ORIGINAL PROJECT
		$fake=new fakeuser;
		//
		$d=new EmpresaEquipamentoItemData;
		//
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

			$e=new Equipamentoitem;
			$e->equipamentodetail_id=$equipamentodetail_id;
			foreach ($success as $key => $value) {
				$e->$key 	=$value;
			}
			$e->status=1;
			//$e->dthr_cadastro=date('Y-m-d');

			$e->sessao_id		=$fake->sessao_id();
			//$e->sessao_id		=$this->id_sessao;
			$e->save();

			$success['id']=$e->id;

			$res=$d->responsedata(
				'equipamentoitem',
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
				'equipamentoitem',
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
	public function show($empresa_id,$equipamentodetail_id,$id)
	{
		$d=new EmpresaEquipamentoItemData;
		return $d->show($id);
		//
	}

	public function showvisible($empresa_id,$equipamentodetail_id,$id)
	{
		$d=new EmpresaEquipamentoItemData;
		try {
			if (Equipamentoitem::whereId($id)->count()==0) {
				$res=$d->responsedata(
					'equipamentoitem',
					false,
					'show',
					$d->noexist
					)
				;
				$res=json_encode($res);
				throw new Exception($res);
			}
			//
			$header			=$d->header();
			$equipamentoitem=$d->show($id);
			$empresa=Empresa::find($empresa_id);
			$pivot_id=Equipamentodetail::find($equipamentodetail_id)
			->empresa_equipamento_id;
			$equipamento=EmpresaEquipamento::find($pivot_id)->equipamento;
			return View::make(
				'tempviews.EmpresaEquipamentoItem.show',
				compact(
					'empresa_id',
					'equipamentodetail_id',
					'id',
					'header',
					'equipamentoitem',
					'empresa',
					'equipamento'
					//
					)
				)
			;

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
	public function edit($empresa_id,$equipamentodetail_id,$id)
	{
		$d=new EmpresaEquipamentoItemData;
		try {
			if (Equipamentoitem::whereId($id)->count()==0) {
				$res=$d->responsedata(
					'equipamentoitem',
					false,
					'edit',
					$d->noexist
					)
				;
				$res=json_encode($res);
				throw new Exception($res);
			}
			//
			$header			=$d->header();
			$equipamentoitem=$d->show($id);
			$empresa=Empresa::find($empresa_id);
			$pivot_id=Equipamentodetail::find($equipamentodetail_id)
			->empresa_equipamento_id;
			$equipamento=EmpresaEquipamento::find($pivot_id)->equipamento;
			return View::make(
				'tempviews.EmpresaEquipamentoItem.edit',
				compact(
					'empresa_id',
					'equipamentodetail_id',
					'id',
					'header',
					'equipamentoitem',
					'empresa',
					'equipamento'
					//
					)
				)
			;

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
	public function update($empresa_id,$equipamentodetail_id,$id)
	{
		//instantiate fake user (for empresa and sessao)
		//SHOULD BE DELETED IN ORIGINAL PROJECT
		$fake=new fakeuser;
		//
		$d=new EmpresaEquipamentoItemData;
		//
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

			$e=Equipamentoitem::find($id);
			foreach ($success as $key => $value) {
				$e->$key 	=$value;
			}
			//$e->dthr_cadastro=date('Y-m-d');
			$e->sessao_id		=$fake->sessao_id();
			$e->save();	

			//response structure required for angularjs
			$res=$d->responsedata(
				'equipamentoitem',
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
				'equipamentoitem',
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
	public function destroy($empresa_id,$equipamentodetail_id,$id)
	{
		$d=new EmpresaEquipamentoItemData;
		//
	}
}
