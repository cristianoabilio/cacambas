<?php
/**
 *  class only contains data related to
 * the table Compras
 */
class EmpresaResumoempresaclienteData extends StandardResponse{
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
			array('cliente_id',1)
			,array('mes_referencia',0)
			,array('ano_referencia',0)
			,array('total_locacoes',0)
			,array('total_aberto',0)
			,array('total_recebido',0)
			,array('total_atrasado',0)
		);	
		return $header;
	}
	
	/**
	* @param edata retrieves all data from table "empresa"
	*/
	public function edata ($empresa) {
		return Empresa::find($empresa)->Resumoempresacliente;
	}

	public function show($id){
		return Resumoempresacliente::find($id);
	}

	/**
	* @param formdata returns array with form values
	*/
	public function formatdata(){

		return array(
			'cliente_id'		=>Input::get('cliente_id'),
			'mes_referencia'	=>Input::get('mes_referencia'),
			'ano_referencia'	=>Input::get('ano_referencia'),
			'total_locacoes'	=>Input::get('total_locacoes'),
			'total_aberto'		=>Input::get('total_aberto'),
			'total_recebido'	=>Input::get('total_recebido'),
			'total_atrasado'	=>Input::get('total_atrasado')
			)
		;
	}

	public function validrules(){
		return array(
			'cliente_id'		=>	'required'
			,'mes_referencia'	=>	'required'
			,'ano_referencia'	=>	'required'
			,'total_locacoes'	=>	'required'
			,'total_aberto'		=>	'required'
			,'total_recebido'	=>	'required'
			,'total_atrasado'	=>	'required'
			
			)
		;
	}

}

class EmpresaResumoempresaclienteController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($id_empresa)
	{
		$d=new EmpresaResumoempresaclienteData;
		return $d->edata($id_empresa);
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
	public function visible($id_empresa)
	{
		$fake=new fakeuser;
		$d=new EmpresaResumoempresaclienteData;
		$data=array(
			//all compras
			'resumoempresacliente'=>$d->edata($fake->empresa()),
			'header'=>$d->header()
			)
		;
		return View::make('tempviews.ResumoEmpresaCliente.index',$data);

	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
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
