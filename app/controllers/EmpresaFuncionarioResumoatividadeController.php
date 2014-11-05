<?php
/**
 * FuncionarioData class only contains data related to
 * the table Funcionario 
 */
class EmpresaFuncionarioResumoatividadeData extends StandardResponse{
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
			array('funcionario_id',0)			
			,array('empresa_id',0)			
			,array('mes_referencia',1)			
			,array('ano_referencia',1)			
			,array('total_os_colocada',1)			
			,array('total_os_troca',0)			
			,array('total_os_retirada',0)			
		);
		return $header;
	}
	
	/**
	* @param edata retrieves all data from table "empresa"
	*/
	public function edata ($funcionario_id) {
		return Funcionario::find($funcionario_id)->Resumoatividade;
	}
	/*public function edata ($id) {
		return Funcionario::all();
	}
	*/
	public function show($id){
		return Resumoatividade::find($id);
	}

	/**
	* @param formdata returns array with form values
	*/
	public function form_data(){

		$formdata= array(
			'mes_referencia'	=>Input::get('mes_referencia'),
			'ano_referencia'	=>Input::get('ano_referencia'),
			'total_os_colocada'	=>Input::get('total_os_colocada'),
			'total_os_troca'	=>Input::get('total_os_troca'),
			'total_os_retirada'	=>Input::get('total_os_retirada')
			)
		;

		$nullable=array(
			//'login_id'	=>Input::get('login_id')
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
			//'funcionario_id'		=>	'required'
			//,'mes_referencia'	=>	'required'
			'ano_referencia'	=>	'required',
			'total_os_colocada'	=>	'required',
			'total_os_troca'	=>	'required',
			'total_os_retirada'	=>	'required'
			// ,'dthr_cadastro'=> timestamp, not required
			// ,'sessao_id'=> sessao, not required
			)
		;
	}

}

class EmpresaFuncionarioResumoatividadeController extends \BaseController {

	public function __construct(){
		$this->beforeFilter('csrf', array('on' => 'post'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($empresa_id,$funcionario_id)
	{
		$d=new EmpresaFuncionarioResumoatividadeData;
		return $d->edata($funcionario_id);
	}

	public function visible($empresa_id,$funcionario_id)
	{
		$d=new EmpresaFuncionarioResumoatividadeData;
		$data=array(
			'resumoatividade'=>$d->edata($funcionario_id),
			'header'=>$d->header(),
			'empresa_id'=>$empresa_id,
			'funcionario_id'=>$funcionario_id
			)
		;
		return View::make('tempviews.EmpresaFuncionarioResumoatividade.index',$data);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($empresa_id,$funcionario_id)
	{
		$data=compact('empresa_id','funcionario_id');
		return View::make('tempviews.EmpresaFuncionarioResumoatividade.create',$data);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($empresa_id,$funcionario_id)
	{
		$d=new EmpresaFuncionarioResumoatividadeData;
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

			$e=new Resumoatividade;	
			foreach ($success as $key => $value) {
				$e->$key 	=$value;
			}
			$e->empresa_id= $empresa_id;
			$e->funcionario_id= $funcionario_id;
			$e->save();

			$res=$d->responsedata(
				'resumoatividade',
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
				'resumoatividade',
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
	public function show($empresa_id,$funcionario_id,$id)
	{
		$d=new EmpresaFuncionarioResumoatividadeData;
		return $d->show($id);
	}

	public function showvisible($empresa_id,$funcionario_id,$id)
	{
		$d=new EmpresaFuncionarioResumoatividadeData;
		$data=array(
			'resumoatividade'	=>$d->show($id),
			'header'	=>$d->header(),
			'empresa_id'=>$empresa_id,
			'funcionario_id'=>$funcionario_id,
			'id'		=>$id
			)
		;
		return View::make('tempviews.EmpresaFuncionarioResumoatividade.show',$data);
	}



	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($empresa_id,$funcionario_id,$id)
	{
		$d=new EmpresaFuncionarioResumoatividadeData;
		$data=array(
			'resumoatividade'	=>$d->show($id),
			'header'	=>$d->header(),
			'empresa_id'=>$empresa_id,
			'funcionario_id'=>$funcionario_id,
			'id'		=>$id
			)
		;
		return View::make('tempviews.EmpresaFuncionarioResumoatividade.edit',$data);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($empresa_id,$funcionario_id,$id)
	{
		$d=new EmpresaFuncionarioResumoatividadeData;
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

			$e=Resumoatividade::find($id);
			foreach ($success as $key => $value) {
				$e->$key 	=$value;
			}
			//$e->empresa_id= $empresa_id;
			//$e->funcionario_id= $funcionario_id;
			$e->save();	

			//response structure required for angularjs
			$res=$d->responsedata(
				'resumoatividade',
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
				'resumoatividade',
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
	public function destroy($empresa_id,$funcionario_id,$id)
	{
		//
	}


}
