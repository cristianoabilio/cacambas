<?php

/**
 * empresaheader class only contains data related to
 * the table Empresa
 */
class enderecodata{
	/** 
	* function name: header.
	* @param header with headers of endereco table
	*/
	public function header(){
		/*
		$enderecoheader= headers on table enderecos
		In order to display or hide on HTML table, set as
		1 (visible) or 2 (not shown)
		*/
		$enderecoheader=array(	
			array('IDEnderecoBase',0)
			,array('numero',1)
			,array('latitude',1)
			,array('longitude',1)
			,array('restricao_hr_inicio',0)
			,array('restricao_hr_fim',0)
			,array('dthr_cadastro',0)
			,array('sessao_id',0)
			)
		;	
		return $enderecoheader;
	}
	
	/**
	* @param edata retrieves all data from table "endereco"
	*/
	public function edata () {
		return Endereco::all();
	}

	public function show($id){
		return Endereco::find($id);
	}
}

class EnderecoController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$d=new enderecodata;
		$data=array(
			//retrieve all "endereco"
			'endereco'=>$d->edata(),

			//retrieving table headers
			'header'=>$d->header()
			)
		;
		return View::make('tempviews.endereco.index',$data);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//form for new Empresa
		return
		View::make(
			'tempviews.endereco.create'
			)
		;
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		try{
			$validator= Validator::make(		
				Input::All(),	
				array(	
					'IDEnderecoBase'=>		'required'
					,'numero'=>				'required'
					,'latitude'=>			'required'
					,'longitude'=>			'required'
					,'restricao_hr_inicio'=>'required'
					,'restricao_hr_fim'=>	'required'
					),
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

			$e=new Endereco;	
			$e->IDEnderecoBase	=Input::get('IDEnderecoBase');
			$e->numero	=Input::get('numero');
			$e->latitude	=Input::get('latitude');
			$e->longitude	=Input::get('longitude');
			$e->restricao_hr_inicio	=Input::get('restricao_hr_inicio');
			$e->restricao_hr_fim	=Input::get('restricao_hr_fim');
			$e->dthr_cadastro	=date('Y-m-d H:i:s');
			$e->sessao_id	=$fake->sessao_id();
			//$e->sessao_id	=$this->id_sessao;
			$e->save();


			$res=$res = array(
				'status'=>'success',
				'msg' => 'SUCCESFULLY SAVED!'
				)
			;


		} catch (Exception $e){
			SysAdminHelper::NotifyError($e->getMessage());
			$res = array('status'=>'error','msg' => json_decode($e->getMessage()));
		}
		return Response::json($res);
			

	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$d=new enderecodata;
		$data=array(
			'endereco' 	=>$d->show($id),
			'header' 	=>$d->header(),
			'id' 		=>$id
			)
		;
		return View::make('tempviews.endereco.show',$data);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$d=new enderecodata;
		$data=array(
			'endereco' 	=>$d->show($id),
			'header' 	=>$d->header(),
			'id' 		=>$id
			)
		;
		return View::make('tempviews.endereco.edit',$data);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		try{
			$validator= Validator::make(			
				Input::All(),	
				array(
					'IDEnderecoBase'		=>	'required'
					,'numero' 				=>	'required'
					,'latitude' 			=>	'required'
					,'longitude'			=>	'required'
					,'restricao_hr_inicio'	=>	'required'
					,'restricao_hr_fim'		=>	'required'
					),	
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

			$e=Endereco::find($id);
			$e->IDEnderecoBase	=Input::get('IDEnderecoBase');
			$e->numero	=Input::get('numero');
			$e->latitude	=Input::get('latitude');
			$e->longitude	=Input::get('longitude');
			$e->restricao_hr_inicio	=Input::get('restricao_hr_inicio');
			$e->restricao_hr_fim	=Input::get('restricao_hr_fim');
			$e->dthr_cadastro	=date('Y-m-d H:i:s');
			$e->sessao_id	=$fake->sessao_id();
			//$e->sessao_id	=$this->id_sessao;
			$e->save();	

			$res=$res = array(
				'status'=>'success',
				'msg' => 'SUCCESFULLY UPDATED!'
				)
			;
		}
		catch (Exception $e){
			SysAdminHelper::NotifyError($e->getMessage());
			$res = array('status'=>'error','msg' => json_decode($e->getMessage()));
		}
		return Response::json($res);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		try{
			Endereco::where('IDEndereco','=',$id)->delete();
			$res = array('status'=>'success','msg' => 'Registro excluído com sucesso!');
		}
		catch(Exception $e){
			SysAdminHelper::NotifyError($e->getMessage());
			$res = array('status'=>'error','msg' => json_decode($e->getMessage()));
		}

		return Response::json($res);
	}
}
