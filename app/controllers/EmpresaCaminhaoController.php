<?php
/**
 * [Table]Data class only contains data related to
 * the table 
 */
class EmpresaCaminhaoData extends StandardResponse{
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
			/*array('empresa_id',1)
			,*/array('placa',1)
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
	public function edata ($empresa_id) {
		return Caminhao::whereStatus(1)->whereEmpresa_id($empresa_id)->get();
	}

	/**
	* @param edata retrieves all data from table "empresa"
	*/
	public function edatadeleted ($empresa_id) {
		return Caminhao::whereStatus(0)->whereEmpresa_id($empresa_id)->get();
	}

	public function show($id){
		return Caminhao::find($id);
	}

	/**
	* @param formdata returns array with form values
	*/
	public function form_data(){
		$fillable=array(
			//'empresa_id',
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
			'marca'		=>	'required'
			,'modelo'	=>	'required'
			,'placa'	=>	'required'
			)
		;
	}

}

class EmpresaCaminhaoController extends \BaseController {
	public function __construct() {
		//$this->beforeFilter('empresa');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($empresa_id)
	{
		$d=new EmpresaCaminhaoData;
		return $d->edata($empresa_id);
		//return 1;
	}

	public function visible ($empresa_id) {
		$d=new EmpresaCaminhaoData;
		$data=array(
			//all caminhao
			'caminhao'=>$d->edata($empresa_id),
			'header'=>$d->header(),
			'caminhao_0'=>$d->edatadeleted($empresa_id),
			'empresa_id'=>$empresa_id
			)
		;
		return View::make('tempviews.EmpresaCaminhao.index',$data);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($empresa_id)
	{
		$data=array(
			'empresa_id'=>$empresa_id
			)
		;
		return View::make('tempviews.EmpresaCaminhao.create',$data);
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

		$d=new EmpresaCaminhaoData;

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
			$e->empresa_id=$empresa_id;
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
	public function show($empresa_id,$id)
	{
		$d=new EmpresaCaminhaoData;
		return $d->show($id);
	}

	public function showvisible($empresa_id,$id) {
		$d=new EmpresaCaminhaoData;

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
				'id'		=>$id,
				'empresa_id'=>$empresa_id
				)
			;
			return View::make('tempviews.EmpresaCaminhao.show',$data);

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
		$d=new EmpresaCaminhaoData;
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
				'id'		=>$id,
				'empresa_id'=>$empresa_id
				)
			;
			return View::make('tempviews.EmpresaCaminhao.edit',$data);
			
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

		$d=new EmpresaCaminhaoData;
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
	public function destroy($empresa_id,$id)
	{
		$d=new EmpresaCaminhaoData;

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

	public function reactivate ($empresa_id,$id) {
		$d=new EmpresaCaminhaoData;

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
