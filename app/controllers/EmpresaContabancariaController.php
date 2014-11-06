<?php

/**
 * ContabancariaData class only contains data related to
 * the table ContaBancaria
 */
class EmpresaContabancariaData extends StandardResponse {
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
	/*public function edata () {
		return 
		Contabancaria::all();
	}*/

	public function edata($empresa_id) {
		return 
		Empresa::find($empresa_id)->contabancaria;
	}

	public function show($id){
		return 
		Contabancaria::find($id);
	}

	/**
	* @return array with form values
	*/
	public function forminputdata(){

		$formdata=array(
			'nome_banco'	=>Input::get('nome_banco'),
			'codigo_banco'	=>Input::get('codigo_banco'),
			'conta'			=>Input::get('conta'),
			'conta_dig'		=>Input::get('conta_dig'),
			'conta_tipo'	=>Input::get('conta_tipo'),
			'agencia'		=>Input::get('agencia'),
			'agencia_dig'	=>Input::get('agencia_dig')
			)
		;

		$nullable=array(
			//'cpf_cnpj'		=>Input::get('cpf_cnpj')
			/*,*/'pj'			=>Input::get('pj')
			//,'titular'		=>Input::get('titular')
			)
		;

		foreach ($nullable as $k => $v) {
			if ( trim($v)!='' ) {
				$formdata[$k]=$v;
			}
			else {
				$formdata[$k]=null;
			}
		}

		return $formdata;
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

class EmpresaContabancariaController extends \BaseController {

	public function __construct(){
		$this->beforeFilter('csrf', array('on' => 'post'));
		$this->beforeFilter('empresa');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($empresa_id)
	{
		$d=new EmpresaContabancariaData;
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
	public function visible($empresa_id)
	{
		$d=new EmpresaContabancariaData;
		$data=array(
			'conta'=>$d->edata($empresa_id),
			'header'=>$d->header(),
			'empresa_id'=>$empresa_id
			)
		;
		return 
		View::make('tempviews.EmpresaContabancaria.index',
			$data);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($empresa_id)
	{
		$d=new EmpresaContabancariaData;
		$data=array(
			'empresa_id'=>$empresa_id
			)
		;
		return 
		View::make('tempviews.EmpresaContabancaria.create',
			$data);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($empresa_id)
	{
		$fake=new fakeuser;

		//instantiating data for the json response
		$d=new EmpresaContabancariaData;
		$success=$d->forminputdata();

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
			$e->empresa_id		=$empresa_id;

			// $succes variable contains array name=>value
			//from the form required in this controller
			foreach ($success as $key => $value) {
				$e->$key = $value;
			}

			$e->dthr_cadastro	=date('Y-m-d H:i:s');
			$e->sessao_id		=$fake->sessao_id();
			//$e->sessao_id	=$this->id_sessao;
			$e->save();

			$success['id']=$e->id;

			$res = $d->responsedata(
				'contabancaria',
				true,
				'store',
				$success
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
	public function show($empresa_id,$id)
	{
		$d=new EmpresaContabancariaData;
		return $d->show($id);
	}


	public function showvisible($empresa_id,$id)
	{
		$d=new EmpresaContabancariaData;
		try {
			if (Contabancaria::whereId($id)->count()==0) {
				$res=$d->responsedata(
					'contabancaria',
					false,
					'show',
					$d->noexist
					)
				;
				$res=json_encode($res);
				throw new Exception($res);
			}
			$data=array(
				'contabancaria'	=>$d->show($id),
				'header'		=>$d->header(),
				'empresa_id'	=> $empresa_id,
				'id'			=> $id
				)
			;
			return 
			View::make('tempviews.EmpresaContabancaria.show',
				$data);
			
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
		$d=new EmpresaContabancariaData;
		try {
			if (Contabancaria::whereId($id)->count()==0) {
				$res=$d->responsedata(
					'contabancaria',
					false,
					'edit',
					$d->noexist
					)
				;
				$res=json_encode($res);
				throw new Exception($res);
			}
			$data=array(
				'contabancaria'	=>$d->show($id),
				'header'		=>$d->header(),
				'empresa_id'	=> $empresa_id,
				'id'=> $id
				)
			;
			return View::make('tempviews.EmpresaContabancaria.edit',$data);
			
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
		$fake=new fakeuser;
		// -delete up to here
		$d=new EmpresaContabancariaData;

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
			$e->empresa_id		=$empresa_id;

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
	public function destroy($empresa_id,$id)
	{
		$d=new EmpresaContabancariaData;

		try{
			if (Contabancaria::whereId($id)->count()==0) {
				throw new Exception(json_encode($d->noexist));
			}

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