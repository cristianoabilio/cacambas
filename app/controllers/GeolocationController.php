<?php
use Carbon\Carbon;

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
	 * 
	 * Return all geolocations from the driver
	 * @param integer $empresa
	 * @param integer $motorista
	 * @param datetime $data_inicio
	 * @param datetime $data_fim
	 * @return array:
	 */
	public function edata ($empresa, $motorista, $data_inicio, $data_fim) {		
		$funcionario = Funcionario::find($motorista); 
		if ($funcionario) {
			if ($funcionario->empresa_id == $empresa) {
				return GeolocationModel::
				where('motorista_id', '=', $motorista)
				->where('data', '>=', $data_inicio)
				->where('data', '<=', $data_fim)->get();				
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
	 * 
	 * return all drivers´s geolocation
	 * @param integer $empresa
	 * @param integer $motorista
	 * @param date $data_inicio
	 * @param date $data_fim
	 * @param time $hora_inicio
	 * @param time$hora_fim
	 * @return response
	 */	
	public function index($empresa, $motorista, $data_inicio = null, $data_fim = null, $hora_inicio = null, $hora_fim = null)
	{				
		$data_inicio = ($data_inicio) ? trim($data_inicio) : date('d-m-Y');
		$data_fim 	 = ($data_fim) ? trim($data_fim) : date('d-m-Y');
		$hora_inicio = ($hora_inicio) ? trim($hora_inicio) : '00:00:00';
		$hora_fim 	 = ($hora_fim) ? trim($hora_fim) : '23:59:59';
		
		
		
		$data_inicio = explode("-", $data_inicio);
		$data_fim	 = explode("-", $data_fim);
		$hora_inicio = explode(":", $hora_inicio);
		$hora_fim    = explode(":", $hora_fim);
		$data_inicio = Carbon::create($data_inicio[2], $data_inicio[1], $data_inicio[0], $hora_inicio[0], $hora_inicio[1], $hora_inicio[2])->toDateTimeString();
		$data_fim    = Carbon::create($data_fim[2], $data_fim[1], $data_fim[0], $hora_fim[0], $hora_fim[1], $hora_fim[2])->toDateTimeString();
		$data_inicio = Carbon::createFromFormat('Y-m-d H:i:s', $data_inicio)->toDateTimeString();
		$data_fim 	 = Carbon::createFromFormat('Y-m-d H:i:s', $data_fim)->toDateTimeString();
				
		$d=new geolocationData;
		return Response::json($d->edata($empresa, $motorista, $data_inicio, $data_fim));
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
