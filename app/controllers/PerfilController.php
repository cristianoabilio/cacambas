<?php
class PerfilData extends StandardResponse{
	/** 
	* function name: header.
	* @param header with headers of perfil table
	*/
	public function header(){
		/*
		$header= headers on table perfils
		In order to display or hide on HTML table, set as
		1 (visible) or 2 (not shown)
		*/
		$header=
		array(	
			array('perfil_id_pai',1)
			,array('nome',1)
			,array('descricao',1)
			//,array('status',1)
			//,array('sessao_id',1)
			//,array('dthr_cadastro',1)
			)
		;	
		return $header;
	}
	
	/**
	* @param edata retrieves all data from table "perfil"
	*/
	public function edata () {
		return Perfil::whereStatus(1)->get();
	}
	/**
	* @param deleted retrieves all data from table "perfil"
	*/
	public function deleted () {
		return Perfil::whereStatus(0)->get();
	}

	public function show($id){
		return Perfil::find($id);
	}

	/**
	* @param formdata returns array with form values
	*/
	public function form_data(){
		$formdata=array(
			'perfil_id_pai'	=>Input::get('perfil_id_pai')
			,'nome'	=>Input::get('nome')
			,'descricao'	=>Input::get('descricao')
			//,'status'	=>Input::get('status')
			//,'sessao_id'	=>Input::get('sessao_id')
			//,'dthr_cadastro'	=>Input::get('dthr_cadastro')

			)
		;

		$nullable=array(
			//restricao_hr_inicio,restricao_hr_fim,complemento,observacao
			)
		;

		foreach ($nullable as $key => $value) {
			if ( trim($value[0])!="" ) {
				$formdata[$key]=$value;
			} else {
				$formdata[$key]=null;
			}
		}

		return $formdata;
	}

	public function validrules(){
		return array(
			'perfil_id_pai'	=>	'required'
			,'nome'			=>	'required'
			,'descricao'	=>	'required'
			//,'status'		=>	'required'
			//,'sessao_id'	=>	'required'
			//,'dthr_cadastro'=>	'required'

			)
		;
	}
}

class PerfilController extends \BaseController {

	public function __construct(){
		//$this->beforeFilter('csrf', array('on' => 'post'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$d=new PerfilData;
		return $d->edata();
	}

	public function visible () {
		$d=new PerfilData;
		$data=array(
			'perfil'=>$d->edata(),
			'deleted'=>$d->deleted(),
			'header'=>$d->header()
			)
		;
		return View::make('tempviews.perfil.index',$data);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('tempviews.perfil.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//instantiate fake user (for perfil and sessao)
		//SHOULD BE DELETED IN ORIGINAL PROJECT
		$fake=new fakeuser;

		$d=new PerfilData;
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

			$e=new Perfil;	
			foreach ($success as $key => $value) {
				$e->$key 	=$value;
			}
			//default status when Empresa is created=1
			$e->status			=1;

			//timestamp
			$e->dthr_cadastro	=date('Y-m-d H:i:s');

			$e->sessao_id		=$fake->sessao_id();
			//$e->sessao_id		=$this->id_sessao;
			
			$e->save();

			$success['id']=$e->id;

			$res=$d->responsedata(
				'perfil',
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
				'perfil',
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
		$d=new PerfilData;
		return $d->show($id);
	}

	public function showvisible($id)
	{
		$d=new PerfilData;
		try {
			if (Perfil::whereId($id)->count()==0) {
				$res=$d->responsedata(
					'perfil',
					false,
					'show',
					$d->noexist
					)
				;
				$res=json_encode($res);
				throw new Exception($res);
			}
			$data=array(
				'perfil' 	=>$d->show($id),
				'header' 	=>$d->header(),
				'id' 		=>$id
				)
			;
			return View::make('tempviews.perfil.show',$data);
			
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
		$d=new PerfilData;
		try {
			if (Perfil::whereId($id)->count()==0) {
				$res=$d->responsedata(
					'perfil',
					false,
					'edit',
					$d->noexist
					)
				;
				$res=json_encode($res);
				throw new Exception($res);
			}
			$data=array(
				'perfil' 	=>$d->show($id),
				'header' 		=>$d->header(),
				'id' 			=>$id
				)
			;
			return View::make('tempviews.perfil.edit',$data);
			
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
	public function update($id)
	{
		$fake=new fakeuser;
		$d=new PerfilData;
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

			$e=Perfil::find($id);
			foreach ($success as $key => $value) {
				$e->$key 	=$value;
			}
			$e->dthr_cadastro	=date('Y-m-d H:i:s');
			$e->sessao_id		=$fake->sessao_id();
			$e->save();	

			//response structure required for angularjs
			$res=$d->responsedata(
				'perfil',
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
				'perfil',
				false,
				'update',
				$validator->messages()
				)
			;
			$code=400;
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
		//
	}


}
