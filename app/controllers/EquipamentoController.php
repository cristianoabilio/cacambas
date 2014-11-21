<?php
class EquipamentoData extends StandardResponse {
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
			array('nome',1)
			,array('classe',1)
			,array('subclasse',1)
			,array('descricao',1)
			)
		;	
		return $header;
	}

	/**
	* @param edata retrieves all data from table "equipamento"
	*/
	public function edata () {
		return Equipamento::all();
	}

	public function show($id){
		return Equipamento::find($id);
	}

	/**
	* @param formdata returns array with form values
	*/
	public function form_data(){
		$fillable=array(
			'nome',
			'classe',
			'subclasse'
			)
		;
		$nullable=array(
			'descricao'
			)
		;
		return $this->formCapture ($fillable,$nullable);
		//
	}

	public function validrules(){
		return array(
			'nome'		=>	'required'
			,'classe'	=>	'required'
			,'subclasse'=>	'required'
			)
		;
	}
}

class EquipamentoController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$d=new EquipamentoData;
		return Response::json($d->edata());
	}

	public function visible () {
		$d=new EquipamentoData;
		$data=array(
			'equipamento'=>$d->edata(),
			'header'=>$d->header()
			)
		;
		return View::make('tempviews.equipamento.index',$data);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('tempviews.equipamento.create');
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
		$d=new EquipamentoData;
		$success=$d->form_data();

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

			$e=new Equipamento;	
			foreach ($success as $key => $value) {
				$e->$key 	=$value;
			}
			$e->status=1;
			$e->sessao_id=$fake->sessao_id();
			$e->save();

			$success['id']=$e->id;

			$res=$d->responsedata(
				'estado',
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
				'estado',
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
		$d=new EquipamentoData;
		return $d->show($id);
	}

	public function showvisible ($id) {
		$d=new EquipamentoData;
		try {
			if (Equipamento::whereId($id)->count()==0) {
				$res=$d->responsedata(
					'equipamentoempresa',
					false,
					'show',
					$d->noexist
					)
				;
				$res=json_encode($res);
				throw new Exception($res);
			}
			$data=array(
				'equipamento' 	=>$d->show($id),
				'header' 	=>$d->header(),
				'id' 		=>$id
				)
			;
			return View::make('tempviews.equipamento.show',$data);
			
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
		$d=new EquipamentoData;
		try {
			if (Equipamento::whereId($id)->count()==0) {
				$res=$d->responsedata(
					'equipamentoempresa',
					false,
					'edit',
					$d->noexist
					)
				;
				$res=json_encode($res);
				throw new Exception($res);
			}
			$data=array(
				'equipamento' 	=>$d->show($id),
				'header' 		=>$d->header(),
				'id' 			=>$id
				)
			;
			return View::make('tempviews.equipamento.edit',$data);
			
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
		$fake=new fakeuser;
		$d=new EquipamentoData;
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

			$e=Equipamento::find($id);
			foreach ($success as $key => $value) {
				$e->$key 	=$value;
			}
			$e->sessao_id		=$fake->sessao_id();
			$e->save();	

			//response structure required for angularjs
			$res=$d->responsedata(
				'equipamento',
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
				'equipamento',
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
		//
	}


}
