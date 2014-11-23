<?php
class EmpresaEquipamentoData extends StandardResponse{
	/** 
	* function name: header.
	* @param header with headers of convenio table
	*/
	public function header(){

		$header=array(	
			array('empresa_equipamento_id',1)
			,array('preco_base',1)
			,array('periodo_minimo',0)
			,array('dia_extra',0)
			,array('preco_extra',0)
			,array('taxa_extra',0)
			,array('multa',0)
			)
		;	
		return $header;
	}
	
	/**
	* @param edata retrieves all data from table "limite"
	*/
	public function edata ($empresa_id) {
		$eq_details_columns=
		'id|preco_base|periodo_minimo|dia_extra|preco_extra|taxa_extra|valor_multa|status|sessao_id|created_at|updated_at'
		;
		$eq_details_columns=explode('|', $eq_details_columns);
		$eq_details=array();
		$i=0;
		//$equipamento=Equipamento::all();
		foreach (Empresa::find($empresa_id)->equipamentodetail as $e) {
			foreach ($eq_details_columns as $k => $v) {
				$eq_details[$i][$v]=$e->$v;
			}
			$empresa_equipamento_id=$e->empresa_equipamento_id;
			$equipamento_id=EmpresaEquipamento::find($empresa_equipamento_id)
			->equipamento_id;

			$equipamento=Equipamento::find($equipamento_id);
			$eq_details[$i]['nome']=$equipamento->nome;
			$eq_details[$i]['classe']=$equipamento->classe;
		}
		return $eq_details;
	}

	public function edatainactive ($empresa_id) {
		//return Equipamento::all();
	}

	public function show($id){
		return Equipamentodetail::find($id);
	}

	/**
	* @param formdata returns array with form values
	*/
	public function form_data(){
		$fillable=array(
			//'equipamento_id'
			//,
			'preco_base'
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
			,'valor_multa'
			)
		;
		return $this->formCapture ($fillable,$nullable);
	}

	public function validrules(){
		return array(
			'equipamento_id'	=>'required'
			,'preco_base'		=>'required'
			,'periodo_minimo'	=>'required'
			)
		;
	}
}

class EmpresaEquipamentoController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($empresa_id)
	{
		$d=new EmpresaEquipamentoData;
		return $d->edata($empresa_id);
		//return 1;
	}

	public function visible ($empresa_id) {
		$d=new EmpresaEquipamentoData;
		$data=array(
			//all equipamento
			'equipamentodetail'=>$d->edata($empresa_id),
			'header'=>$d->header(),
			//'equipamento_0'=>$d->edatadeleted($empresa_id),
			'empresa_id'=>$empresa_id
			)
		;
		return View::make('tempviews.EmpresaEquipamento.index',$data);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($empresa_id)
	{
		$data=array(
			'equipamento'=>Equipamento::all(),
			'empresa_id'=>$empresa_id
			)
		;
		return View::make('tempviews.EmpresaEquipamento.create',$data);
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

		$d=new EmpresaEquipamentoData;

		$success=$d->form_data();

		$mssg='';

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
				$mssg=$validator->messages();
				throw new Exception(
					json_encode(
						array(
							'validation_errors'=>$validator->messages()->all()
							)
						)
					)
				;
			}

			//EXCEPTION FOR REPEATED EQUIPAMENTO RESOURCE
			//Each equipamento can exist only once for each empresa
			//if repeated, code will throw an exception

			//1. retrieving id of equipamento to be added
			$equipamento_id=Input::get('equipamento_id');

			//2. current empresa_equipamento (pivot) records
			$current_empresa_equipamentos=
			EmpresaEquipamento::whereEmpresa_id($empresa_id)
			->get();
			;

			//3. array with current equipamentos id for empresa resource
			$current_equipamentos=array();
			$i=0;
			foreach ($current_empresa_equipamentos as $c) {
				$current_equipamentos[$i]=$c->equipamento->id;
				$i++;
			}

			//returning exception
			if (in_array($equipamento_id, $current_equipamentos)) {
				$mssg='equipamento already exists for this empresa, it cannot be added twice!';
				throw new Exception($mssg);
			}
			//return "saved action was blocked, no worries!";

			$pivot=new EmpresaEquipamento;
			$p=$pivot;
			$p->empresa_id=$empresa_id;
			$p->equipamento_id=$equipamento_id;
			$p->save();
			$empresa_equipamento_id=$p->id;
			$ee_id=$empresa_equipamento_id;

			$e=new Equipamentodetail;
			$e->empresa_equipamento_id=$ee_id;
			foreach ($success as $key => $value) {
				$e->$key 	=$value;
			}
			$e->status=1;

			$e->sessao_id		=$fake->sessao_id();
			//$e->sessao_id		=$this->id_sessao;
			$e->save();

			$success['id']=$e->id;

			$res=$d->responsedata(
				'equipamento',
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
				'equipamento',
				false,
				'store',
				$mssg
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
		$d=new EmpresaEquipamentoData;
		return $d->show($id);
	}

	public function showvisible($empresa_id,$id) {
		$d=new EmpresaEquipamentoData;

		try {
			if (Equipamento::whereId($id)->count()==0) {
				$res=$d->responsedata(
					'equipamento',
					false,
					'show',
					$d->noexist
					)
				;
				$res=json_encode($res);
				throw new Exception($res);
			}
			$data=array(
				'equipamentodetail'	=>$d->show($id),
				'header'	=>$d->header(),
				'id'		=>$id,
				'empresa_id'=>$empresa_id
				)
			;
			return View::make('tempviews.EmpresaEquipamento.show',$data);

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
		$d=new EmpresaEquipamentoData;
		try {
			if (Equipamentodetail::whereId($id)->count()==0) {
				$res=$d->responsedata(
					'equipamento',
					false,
					'edit',
					$d->noexist
					)
				;
				$res=json_encode($res);
				throw new Exception($res);
			}
			$equipamentodetail=$d->show($id);
			$choosen=EmpresaEquipamento::find(
				$equipamentodetail
				->empresa_equipamento_id
				)
			->equipamento_id;
			$currentequipamento=Equipamento::find($choosen);

			//return $choosen;
			;
			$equipamento=Equipamento::all();
			$header=$d->header();
			
			return View::make('tempviews.EmpresaEquipamento.edit',
				compact(
					'equipamentodetail',
					'choosen',
					'currentequipamento',
					'equipamento',
					'header',
					'empresa_id',
					'id'
					)
				);
			
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

		$d=new EmpresaEquipamentoData;
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
			//
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
		$d=new EmpresaEquipamentoData;

		try{
			if (Equipamento::whereId($id)->count()==0) {
				throw new Exception(json_encode($d->noexist));
				$code=400;
			}

			$c=Equipamento::find($id);
			$c->status=0;
			$c->save();
			//::whereId($id)->delete();
			$res=$d->responsedata(
				'equipamento',
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
				'equipamento',
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
		$d=new EmpresaEquipamentoData;

		try{
			if (Equipamento::whereId($id)->count()==0) {
				throw new Exception(json_encode($d->noexist));
				$code=400;
			}

			$c=Equipamento::find($id);
			$c->status=1;
			$c->save();

			$res=$d->responsedata(
				'equipamento',
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
				'equipamento',
				false,
				'restore',
				array('msg' => json_decode($e->getMessage()))
				)
			;
			$code=400;
		}

		return Response::json($res,$code);
	}

	public function Equipamentbaseandpreco  ($id) {
		$header=array(
			'id',
			'equipamentobase_id',
			'empresa_id',
			'preco_base',
			'periodo_minimo',
			'dia_extra',
			'preco_extra',
			'taxa_extra',
			'multa',
			'status',
			'sessao_id',
			'dthr_cadastro'
			)
		;
		$equip_b_p=array();
		$i=0;
		foreach (Empresa::find($id)->equipamento as $key => $e) {
			$equip_b_p[$i]['classe']=$e->equipamentobase->classe;
			foreach ($header as $v) {
				$equip_b_p[$i][$v]=$e->$v;
			}
			$i++;
		}
		return $equip_b_p;
	}
}
