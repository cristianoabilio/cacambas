<?php
/**
 * [Table]Data class only contains data related to
 * the table 
 */
class SessaoData extends StandardResponse{
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
			array('login_id',1)
			,array('dthr_login',1)
			,array('dthr_logoff',1)
			,array('ip',1)
			,array('laravel_session_id',1)
		);	
		return $header;
	}
	
	/**
	* @param edata retrieves all data from table "empresa"
	*/
	public function edata () {
		return Sessao::all();
	}

	public function show($id){
		return Sessao::find($id);
	}

	/**
	* @param formdata returns array with form values
	*/
	public function form_data(){

		return array(
			/*'login_id'				=>Input::get('login_id')
			,'dthr_login'			=>Input::get('dthr_login')
			,'dthr_logoff'			=>Input::get('dthr_logoff')
			,'ip'					=>Input::get('ip')
			,'laravel_session_id'	=>Input::get('laravel_session_id')*/
			)
		;
	}

	public function validrules(){
		return array(
			/*'nome'		=>	'required'
			,'detalhe'=>	'required'*/
			)
		;
	}

}

class SessaoController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return Sessao::all();
	}


	public function visible()
	{
		$d=new SessaoData;
		$data=array(
			//all sessao
			'sessao'=>$d->edata(),
			'header'=>$d->header()
			)
		;
		return View::make('tempviews.sessao.index',$data);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$data=array();
		return View::make('tempviews.sessao.create',$data);
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
		$d=new SessaoData;
		return $d->show($id);
	}

	public function showvisible ($id) {
		$d=new SessaoData;
		try {
			if (Sessao::whereId($id)->count()==0) {
				$res=$d->responsedata(
					'sessao',
					false,
					'show',
					$d->noexist
					)
				;
				$res=json_encode($res);
				throw new Exception($res);
			}
			$data=array(
				'sessao'	=>$d->show($id),
				'header'	=>$d->header(),
				'id'		=>$id
				)
			;
			return View::make('tempviews.sessao.show',$data);

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
		return View::make('tempviews.sessao.edit');
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
