<?php
class GeolocationData extends StandardResponse{
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
		array('id',1)
		,array('motorista_id',1)
		,array('latitude',1)
		,array('longitude',1)
		,array('data',1)
		,array('velocidade',1)
		,array('created_at',1)
		,array('update_at',1)
		);
		return $header;
	}

	/**
	 * @param edata retrieves all data from table "geolocation"
	 */
	public function edata ($empresa, $motorista) {
		$funcionario = Funcionario::find($motorista); 
		if ($funcionario) {
			if ($funcionario->empresa_id == $empresa) {
				return GeolocationModel::
				where('motorista_id', '=', $motorista)->get();				
			}
		}
		return array();	
	}

	public function show ($id) {
		return GeolocationModel::find($id);
	}
}
class GeolocationController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($empresa, $motorista)
	{
		$d=new geolocationData;
		return Response::json($d->edata($empresa, $motorista));
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
