<?php

/**						
* resumoatividadedata class only contains data related to						
 * the table resumoatividade						
 */						
class resumoatividadedata{						
	/** 					
	* function name: header.					
	* @param header with headers of empresa table					
	*/					
	public function header(){					
		/*				
		$header= headers on table resumoatividade				
		In order to display or hide on HTML table, set as				
		1 (visible) or 2 (not shown)				
		*/				
		$header=array(				
			array('funcionario_id',1)			
			,array('empresa_id',1)			
			,array('mes_referencia',0)			
			,array('ano_referencia',0)			
			,array('total_os_colocada',1)			
			,array('total_os_troca',0)			
			,array('total_os_retirada',0)			
		);				
		return $header;				
	}					
						
	/**					
	* @param edata retrieves all data from table "empresa"					
	*/					
	public function edata () {					
		return Empresa::all();				
	}					
						
	public function show($id){					
		return Empresa::find($id)->first();				
	}					
						
	/**					
	* @param formdata returns array with form values					
	*/					
	public function formdata(){					
						
		return array(				
			'funcionario_id'		=>Input::get('funcionario_id'),
			'empresa_id'			=>Input::get('empresa_id'),
			'mes_referencia'		=>Input::get('mes_referencia'),
			'ano_referencia'		=>Input::get('ano_referencia'),
			'total_os_colocada'		=>Input::get('total_os_colocada'),
			'total_os_troca'		=>Input::get('total_os_troca'),
			'total_os_retirada'		=>Input::get('total_os_retirada')
			)
		;
	}					
}						



class ResumoatividadeController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data=array();
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
		return View::make('tempviews.ResumoEmpresaCliente.create',$data);
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
		$fake=new fake;
		//
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
		return View::make('tempviews.ResumoEmpresaCliente.show',$data);
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
		return View::make('tempviews.ResumoEmpresaCliente.edit',$data);
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
		$fake=new fake;
		//
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
