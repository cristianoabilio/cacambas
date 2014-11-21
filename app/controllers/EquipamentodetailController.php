<?php
class EquipamentodetailData extends StandardResponse {
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
			array('equipamentobase_id',1)
			,array('empresa_id',1)
			,array('preco_base',1)
			,array('periodo_minimo',1)
			,array('dia_extra',0)
			,array('preco_extra',0)
			,array('taxa_extra',0)
			,array('multa',0)
			)
		;
		return $header;
	}

	/**
	* @param edata retrieves all data from table "equipamento"
	*/
	public function edata () {
		return Equipamentodetail::all();
	}

	public function show($id){
		return Equipamentodetail::find($id);
	}

	/**
	* @param formdata returns array with form values
	*/
	public function form_data(){
		$formdata=array(
			//'equipamentobase_id'	=>Input::get('equipamentobase_id')
			//,'empresa_id'	=>Input::get('empresa_id')
			//,
			'preco_base'		=>Input::get('preco_base')
			,'periodo_minimo'	=>Input::get('periodo_minimo')
			,'dia_extra'		=>Input::get('dia_extra')
			,'preco_extra'		=>Input::get('preco_extra')
			,'taxa_extra'		=>Input::get('taxa_extra')
			,'multa'			=>Input::get('multa')
			//,'status'	=>Input::get('status')
			//,'sessao_id'	=>Input::get('sessao_id')
			//,'dthr_cadastro'	=>Input::get('dthr_cadastro')


			)
		;

		$nullable=array(
			//
			//
			)
		;

		foreach ($nullable as $key => $value) {
			if ( trim($value)!="" ) {
				$formdata[$key]=$value;
			} else {
				$formdata[$key]=null;
			}
		}

		return $formdata;
	}

	public function validrules(){
		return array(
			//'equipamentobase_id'=>	'required'
			//,'empresa_id'=>	'required'
			//,
			'preco_base'		=>	'required'
			,'periodo_minimo'	=>	'required'
			,'dia_extra'		=>	'required'
			,'preco_extra'		=>	'required'
			,'taxa_extra'		=>	'required'
			//,'multa'=>	'required'
			//,'status'=>	'required'
			//,'sessao_id'=>	'required'
			//,'dthr_cadastro'=>	'required'
			)
		;
	}
}

class EquipamentodetailController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$d=new EquipamentodetailData;
		return Response::json($d->edata());
	}

	public function visible () {
		$d=new EquipamentodetailData;
		$data=array(
			'equipamentodetail'=>$d->edata(),
			'header'=>$d->header()
			)
		;
		return View::make('tempviews.equipamentodetail.index',$data);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('tempviews.equipamentodetail.create');
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
		/*$fake=new fakeuser;
		//
		$d=new EquipamentodetailData;
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

			$e=new Equipamentodetail;	
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
		return Response::json($res,$code);*/
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$d=new EquipamentodetailData;
		return $d->show($id);
	}

	public function showvisible ($id) {
		$d=new EquipamentodetailData;
		try {
			if (Equipamentodetail::whereId($id)->count()==0) {
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
				'equipamentodetail' 	=>$d->show($id),
				'header' 	=>$d->header(),
				'id' 		=>$id
				)
			;
			return View::make('tempviews.equipamentodetail.show',$data);
			
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
		$d=new EquipamentodetailData;
		try {
			if (Equipamentodetail::whereId($id)->count()==0) {
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
				'equipamentodetail' 	=>$d->show($id),
				'header' 		=>$d->header(),
				'id' 			=>$id
				)
			;
			return View::make('tempviews.equipamentodetail.edit',$data);
			
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
		$d=new EquipamentodetailData;
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

			$e=Equipamentodetail::find($id);
			foreach ($success as $key => $value) {
				$e->$key 	=$value;
			}
			$e->dthr_cadastro	=date('Y-m-d H:i:s');
			$e->sessao_id		=$fake->sessao_id();
			$e->save();	

			//response structure required for angularjs
			$res=$d->responsedata(
				'equipamentodetail',
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
				'equipamentodetail',
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
