<?php
class EmpresaEquipamentobaseprecoData extends StandardResponse{
	/** 
	* function name: header.
	* @param header with headers of convenio table
	*/
	public function header(){

		$header=array(	
			array('equipamentobase_id',1)
			//,array('empresa_id',1)
			,array('preco_base',1)
			,array('periodo_minimo',0)
			,array('dia_extra',0)
			,array('preco_extra',0)
			,array('taxa_extra',0)
			,array('multa',0)
			//,array('status',1)
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
		//return Equipamentobasepreco::whereStatus_equipamentobasepreco(1)->get();
		return  Empresa::find($empresa_id)->equipamentobasepreco;
	}

	public function edatainactive ($empresa_id) {
		return Equipamentobasepreco::all();
	}

	public function show($id){
		return Equipamentobasepreco::find($id);
	}

	/**
	* @param formdata returns array with form values
	*/
	public function form_data(){
		$fillable=array(
			'equipamentobase_id'
			,'preco_base'
			,'periodo_minimo'
			//,'status'
			//,'sessao_id'
			//,'dthr_cadastro'

			)
		;
		$nullable=array(
			'dia_extra'
			,'preco_extra'
			,'taxa_extra'
			,'multa'
			)
		;
		return $this->formCapture ($fillable,$nullable);

	}

	public function validrules(){
		return array(
			'equipamentobase_id'=>'required'
			,'preco_base'		=>'required'
			,'periodo_minimo'	=>'required'
			)
		;
	}
}

class EmpresaEquipamentobaseprecoController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($empresa_id)
	{
		$d=new EmpresaEquipamentobaseprecoData;
		return $d->edata($empresa_id);
		//return 1;
	}

	public function visible ($empresa_id) {
		$d=new EmpresaEquipamentobaseprecoData;
		$data=array(
			//all equipamentobasepreco
			'equipamentobasepreco'=>$d->edata($empresa_id),
			'header'=>$d->header(),
			//'equipamentobasepreco_0'=>$d->edatadeleted($empresa_id),
			'empresa_id'=>$empresa_id
			)
		;
		return View::make('tempviews.EmpresaEquipamentobasepreco.index',$data);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($empresa_id)
	{
		$data=array(
			'equipamentobase'=>Equipamentobase::all(),
			'empresa_id'=>$empresa_id
			)
		;
		return View::make('tempviews.EmpresaEquipamentobasepreco.create',$data);
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

		$d=new EmpresaEquipamentobaseprecoData;

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

			$e=new Equipamentobasepreco;
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
				'equipamentobasepreco',
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
				'equipamentobasepreco',
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
		$d=new EmpresaEquipamentobaseprecoData;
		return $d->show($id);
	}

	public function showvisible($empresa_id,$id) {
		$d=new EmpresaEquipamentobaseprecoData;

		try {
			if (Equipamentobasepreco::whereId($id)->count()==0) {
				$res=$d->responsedata(
					'equipamentobasepreco',
					false,
					'show',
					$d->noexist
					)
				;
				$res=json_encode($res);
				throw new Exception($res);
			}
			$data=array(
				'equipamentobasepreco'	=>$d->show($id),
				'header'	=>$d->header(),
				'id'		=>$id,
				'empresa_id'=>$empresa_id
				)
			;
			return View::make('tempviews.EmpresaEquipamentobasepreco.show',$data);

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
		$d=new EmpresaEquipamentobaseprecoData;
		try {
			if (Equipamentobasepreco::whereId($id)->count()==0) {
				$res=$d->responsedata(
					'equipamentobasepreco',
					false,
					'edit',
					$d->noexist
					)
				;
				$res=json_encode($res);
				throw new Exception($res);
			}
			$data=array(
				'equipamentobasepreco'	=>$d->show($id),
				'equipamentobase'=>Equipamentobase::all(),
				'header'	=>$d->header(),
				'id'		=>$id,
				'empresa_id'=>$empresa_id
				)
			;
			return View::make('tempviews.EmpresaEquipamentobasepreco.edit',$data);
			
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

		$d=new EmpresaEquipamentobaseprecoData;
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

			$e=Equipamentobasepreco::find($id);
			foreach ($success as $key => $value) {
				$e->$key 	=$value;
			}
			$e->dthr_cadastro=date('Y-m-d');
			$e->sessao_id		=$fake->sessao_id();
			$e->save();	

			//response structure required for angularjs
			$res=$d->responsedata(
				'equipamentobasepreco',
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
				'equipamentobasepreco',
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
		$d=new EmpresaEquipamentobaseprecoData;

		try{
			if (Equipamentobasepreco::whereId($id)->count()==0) {
				throw new Exception(json_encode($d->noexist));
				$code=400;
			}

			$c=Equipamentobasepreco::find($id);
			$c->status=0;
			$c->save();
			//::whereId($id)->delete();
			$res=$d->responsedata(
				'equipamentobasepreco',
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
				'equipamentobasepreco',
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
		$d=new EmpresaEquipamentobaseprecoData;

		try{
			if (Equipamentobasepreco::whereId($id)->count()==0) {
				throw new Exception(json_encode($d->noexist));
				$code=400;
			}

			$c=Equipamentobasepreco::find($id);
			$c->status=1;
			$c->save();

			$res=$d->responsedata(
				'equipamentobasepreco',
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
				'equipamentobasepreco',
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
