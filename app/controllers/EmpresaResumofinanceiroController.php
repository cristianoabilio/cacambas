<?php
/**
 *  class only contains data related to
 * the table mentioned on this controller
 */
class EmpresaResumofinanceiroData extends StandardResponse{
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
			array('mes_referencia',1)
			,array('ano_referencia',1)
			,array('total_locacoes_colocada',1)
			,array('total_locacoes_troca',0)
			,array('total_locacoes_retirada',0)
			,array('total_os_colocada',0)
			,array('total_os_troca',0)
			,array('total_os_retirada',0)
			,array('total_recebimento_aberto',0)
			,array('total_recebimento_recebido',0)
			,array('total_recebimento_atrasado',0)
			,array('total_despesa_imposto',0)
			,array('total_despesa_pessoal',0)
			,array('total_despesa_fixa',0)
			,array('total_despesa_variavel',0)
			,array('total_despesa_manutencao',0)
			,array('total_fluxo_caixa',0)
			,array('total_boletos_pagos',0)
			,array('total_pagamentos_cartao',0)
			)
		;	
		return $header;
	}
	
	/**
	* @param edata retrieves all data from table "empresa"
	*/
	public function edata ($empresa) {
		return Empresa::find($empresa)
		->Resumofinanceiro;
	}

	public function show($id){
		return Resumofinanceiro::find($id);
	}

	/**
	* @param formdata returns array with form values
	*/
	public function form_data(){

		return array(
			'mes_referencia'			=>Input::get('mes_referencia'),
			'ano_referencia'			=>Input::get('ano_referencia'),
			'total_locacoes_colocada'	=>Input::get('total_locacoes_colocada'),
			'total_locacoes_troca'		=>Input::get('total_locacoes_troca'),
			'total_locacoes_retirada'	=>Input::get('total_locacoes_retirada'),
			'total_os_colocada'			=>Input::get('total_os_colocada'),
			'total_os_troca'			=>Input::get('total_os_troca'),
			'total_os_retirada'			=>Input::get('total_os_retirada'),
			'total_recebimento_aberto'	=>Input::get('total_recebimento_aberto'),
			'total_recebimento_recebido'=>Input::get('total_recebimento_recebido'),
			'total_recebimento_atrasado'=>Input::get('total_recebimento_atrasado'),
			'total_despesa_imposto'		=>Input::get('total_despesa_imposto'),
			'total_despesa_pessoal'		=>Input::get('total_despesa_pessoal'),
			'total_despesa_fixa'		=>Input::get('total_despesa_fixa'),
			'total_despesa_variavel'	=>Input::get('total_despesa_variavel'),
			'total_despesa_manutencao'	=>Input::get('total_despesa_manutencao'),
			'total_fluxo_caixa'			=>Input::get('total_fluxo_caixa'),
			'total_boletos_pagos'		=>Input::get('total_boletos_pagos'),
			'total_pagamentos_cartao'	=>Input::get('total_pagamentos_cartao')

				)
		;
	}

	public function validrules(){
		return array(
			'mes_referencia'				=>	'required'
			,'ano_referencia'				=>	'required'
			,'total_locacoes_colocada'		=>	'required'
			,'total_locacoes_troca'			=>	'required'
			,'total_locacoes_retirada'		=>	'required'
			,'total_os_colocada'			=>	'required'
			,'total_os_troca'				=>	'required'
			,'total_os_retirada'			=>	'required'
			,'total_recebimento_aberto'		=>	'required'
			,'total_recebimento_recebido'	=>	'required'
			,'total_recebimento_atrasado'	=>	'required'
			,'total_despesa_imposto'		=>	'required'
			,'total_despesa_pessoal'		=>	'required'
			,'total_despesa_fixa'			=>	'required'
			,'total_despesa_variavel'		=>	'required'
			,'total_despesa_manutencao'		=>	'required'
			,'total_fluxo_caixa'			=>	'required'
			//,'total_boletos_pagos'			=>	'required'
			//,'total_pagamentos_cartao'		=>	'required'

			// ,'dthr_cadastro'=> timestamp, not required
			// ,'sessao_id'=> sessao, not required
			)
		;
	}

}

class EmpresaResumofinanceiroController extends \BaseController {

	public function __construct(){
		$this->beforeFilter('csrf', array('on' => 'post'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($empresa_id)
	{
		$d=new EmpresaResumofinanceiroData;
		return Response::json($d->edata($empresa_id));
	}



	/**
	* Visible action IS NOT A RESTFUL RESOURCE 
	* but is required for generating the view
	* with access links to each resource,
	* this is, the visible index page.
	* The reason of this method is because the
	* index resource will throw a JSON object
	* and no view at all.
	*/
	public function visible ($empresa_id) {
		$fake=new fakeuser;
		$d=new EmpresaResumofinanceiroData;
		$data=array(
			//all compras
			'resumofinanceiro'	=>$d->edata($empresa_id),
			'header'			=>$d->header(),
			'empresa_id' 		=>$empresa_id
			)
		;
		return View::make('tempviews.Empresaresumofinanceiro.index',$data);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($empresa_id)
	{
		$data=compact('empresa_id');
		return View::make('tempviews.Empresaresumofinanceiro.create',$data);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($empresa_id)
	{
		$d=new EmpresaResumofinanceiroData;
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

			$e=new Resumofinanceiro;
			$e->empresa_id=$empresa_id;
			foreach ($success as $key => $value) {
				$e->$key 	=$value;
			}
			
			$e->save();

			$success['id']=$e->id;

			$res=$d->responsedata(
				'resumofinanceiro',
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
				'resumofinanceiro',
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
		$d=new EmpresaResumofinanceiroData;
		return $d->show($id);
	}


	public function showvisible($empresa_id,$id)
	{
		$d=new EmpresaResumofinanceiroData;
		try {
			if (Resumofinanceiro::whereId($id)->count()==0) {
				$res=$d->responsedata(
					'resumofinaceiro',
					false,
					'show',
					$d->noexist
					)
				;
				$res=json_encode($res);
				throw new Exception($res);
			}
			$data=array(
				'resumofinanceiro'	=>$d->show($id),
				'header'	=>$d->header(),
				'id'		=>$id,
				'empresa_id'=>$empresa_id
				)
			;
			return View::make('tempviews.Empresaresumofinanceiro.show',$data);
			
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
		$d=new EmpresaResumofinanceiroData;
		try {
			if (Resumofinanceiro::whereId($id)->count()==0) {
				$res=$d->responsedata(
					'resumofinaceiro',
					false,
					'edit',
					$d->noexist
					)
				;
				$res=json_encode($res);
				throw new Exception($res);
			}
			$data=array(
				'resumofinanceiro'	=>$d->show($id),
				'header'			=>$d->header(),
				'id'				=>$id,
				'empresa_id'		=>$empresa_id
				)
			;
			return View::make('tempviews.Empresaresumofinanceiro.edit',$data);
			
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
		$d=new EmpresaResumofinanceiroData;
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

			$e=Resumofinanceiro::find($id);
			foreach ($success as $key => $value) {
				$e->$key 	=$value;
			}

			$e->save();	

			//response structure required for angularjs
			$res=$d->responsedata(
				'resumofinanceiro',
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
				'resumofinanceiro',
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
		//
	}


}
