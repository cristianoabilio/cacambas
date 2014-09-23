<?php

/**
 * ContabancariaData class only contains data related to
 * the table ContaBancaria
 */
class ContabancariaData extends StandardResponse {
	/** 
	* function name: header.
	* @param header with headers of contabancaria table
	*/
	public function header(){
		/*
		$header headers on table contabancarias
		In order to display or hide on HTML table, set as
		1 (visible) or 2 (not shown)
		*/
		$header=array(	
			array('nome_banco',1)
			,array('codigo_banco',1)
			,array('conta',1)
			,array('conta_dig',1)
			,array('conta_tipo',0)
			,array('agencia',0)
			,array('agencia_dig',0)
			,array('cpf_cnpj',0)
			,array('pj',0)
			,array('titular',0)
			,array('dthr_cadastro',0)
			,array('sessao_id',0)
			)
		;	
		return $header;
	}
	
	/**
	* @return all records from table "contabancaria"
	*/
	public function edata () {
		return 
		Contabancaria::all();
	}

	public function edataempresa ($empresa) {
		return 
		Empresa::find($empresa)->contabancaria;
	}

	public function show($id){
		return 
		Contabancaria::find($id);
	}

	/**
	* @return array with form values
	*/
	public function forminputdata(){

		return array(
			'nome_banco'	=>Input::get('nome_banco'),
			'codigo_banco'	=>Input::get('codigo_banco'),
			'conta'			=>Input::get('conta'),
			'conta_dig'		=>Input::get('conta_dig'),
			'conta_tipo'	=>Input::get('conta_tipo'),
			'agencia'		=>Input::get('agencia'),
			'agencia_dig'	=>Input::get('agencia_dig'),
			'cpf_cnpj'		=>Input::get('cpf_cnpj'),
			'pj'			=>Input::get('pj'),
			'titular'		=>Input::get('titular')
				)
		;
	}

	public function validrules(){
		return array(
			'nome_banco'		=>	'required'
			,'codigo_banco'		=>	'required|integer'
			,'conta'			=>	'required'
			,'conta_dig'		=>	'required'
			,'conta_tipo'		=>	'required'
			,'agencia'			=>	'required'
			,'agencia_dig'		=>	'required'
			,'cpf_cnpj'			=>	'required'
			//,'pj'				=>	'required'
			,'titular'			=>	'required'
			)
		;
	}

}

class ContabancariaController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$d=new ContabancariaData;
		$data=array(
			'conta'=>$d->edata(),
			'header'=>$d->header()
			)
		;
		return 
		View::make('tempviews.contabancaria.index',
			$data);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return
		View::make(
			'tempviews.contabancaria.create'
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
		/**
		* instantiating fake user (for empresa and sessao)
		* through "fakenuser" class
		* Should be deleted in original project
		*/
		$fake=new fakeuser;
		// -delete up to here

		//instantiating data for the json response
		$d=new ContabancariaData;
		$succesdata=$d->forminputdata();

		try{
			$validator= Validator::make(			
				Input::All(),
				$d->validrules(),
				$d->validationmssg()
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

			$e=new Contabancaria;	
			$e->empresa_id		=$fake->empresa();

			// $succes variable contains array name=>value
			//from the form required in this controller
			foreach ($succesdata as $key => $value) {
				$e->$key = $value;
			}

			$e->dthr_cadastro	=date('Y-m-d H:i:s');
			$e->sessao_id		=$fake->sessao_id();
			//$e->sessao_id	=$this->id_sessao;
			$e->save();	

			$res = $d->responsedata(
				'contabancaria',
				true,
				'store',
				$succesdata
				)
			;
			$code=200;
		}
		catch (Exception $e){
			SysAdminHelper::NotifyError($e->getMessage());
			$res = $d->responsedata(
				'contabancaria',
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
	public function show($id)
	{
		$d=new ContabancariaData;
		$data=array(
			'conta'=>$d->show($id),
			'header'=>$d->header(),
			'id'=> $id
			)
		;
		return 
		View::make('tempviews.contabancaria.show',
			$data);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$d=new ContabancariaData;
		$data=array(
			'conta'=>$d->show($id),
			'header'=>$d->header(),
			'id'=> $id
			)
		;
		return View::make('tempviews.contabancaria.edit',$data);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		/**
		* instantiating fake user (for empresa and sessao)
		* through "fakenuser" class
		* Should be deleted in original project
		*/
		$fake=new fakeuser;
		// -delete up to here

		//instantiating data for the json response
		$d=new ContabancariaData;
		$succesdata=$d->forminputdata();
		
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

			$e=Contabancaria::find($id);
			$e->empresa_id		=$fake->empresa();

			// $succes variable contains array name=>value
			//from the form required in this controller
			foreach ($succesdata as $key => $value) {
				$e->$key = $value;
			}

			$e->dthr_cadastro	=date('Y-m-d H:i:s');
			$e->sessao_id		=$fake->sessao_id();
			//$e->sessao_id	=$this->id_sessao;
			$e->save();

			$res = $d->responsedata(
				'contabancaria',
				true,
				'update',
				$succesdata
				)
			;
			$code=200;
		}
		catch (Exception $e){
			SysAdminHelper::NotifyError($e->getMessage());
			$res = $d->responsedata(
				'contabancaria',
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
	public function destroy($id)
	{
		$d=new ContabancariaData;
		try{

			Contabancaria::whereId($id)
			->delete();	

			$res = $d->responsedata(
				'contabancaria',
				true,
				'delete',
				array('msg' => 'Registro excluído com sucesso!')
				)
			;
			$code=200;

		}catch(Exception $e){

			SysAdminHelper::NotifyError($e->getMessage());

			$res = $d->responsedata(
				'contabancaria',
				false,
				'delete',
				array('msg' => json_decode($e->getMessage()))
				)
			;
			$code=400;

		}

		return Response::json($res,$code);
	}
}
