<?php

/**
 * [Table]Data class only contains data related to
 * the table 
 */
class ClassesubclasseData extends StandardResponse{
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
			array('nome',1)
			,array('detalhe',1)

		);	
		return $header;
	}
	
	/**
	* @param edata retrieves all data from table "empresa"
	*/
	public function edata ($classe_id) {
		return Classe::find($classe_id)->subclasse;
	}

	public function show($id){
		return Subclasse::find($id);
	}

	/**
	* @param formdata returns array with form values
	*/
	public function formatdata(){

		return array(
				'nome'		=>Input::get('nome')
				,'detalhe'	=>Input::get('detalhe')

				)
		;
	}

	public function validrules(){
		return array(
			'nome'		=>	'required'
			,'detalhe'	=>	'required'
			)
		;
	}

}

class ClassesubclasseController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($id)
	{
		$d=new ClassesubclasseData;
		return $d->edata($id);
	}

	public function visible($id)
	{
		$d=new ClassesubclasseData;
		$data=array(
			//all subclasse
			'subclasse'=>$d->edata($id),
			'header'=>$d->header(),
			'id'=>$id
			)
		;
		return View::make('tempviews.ClasseSubclasse.index',$data);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($id)
	{
		return View::make(
			'tempviews.ClasseSubclasse.create',
			compact('id')
			)
		;
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($id)
	{
		//instantiate fake user (for empresa and sessao)
		//SHOULD BE DELETED IN ORIGINAL PROJECT
		$fake=new fakeuser;

		$d=new ClassesubclasseData;

		$success=$d->formatdata();

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

			$e=new Subclasse;
			foreach ($success as $key => $value) {
				$e->$key 	=$value;
			}
			$e->classe_id=$id;
			$e->status=1;
			$e->dthr_cadastro=date('Y-m-d');

			$e->sessao_id		=$fake->sessao_id();
			//$e->sessao_id		=$this->id_sessao;
			$e->save();

			$success['id']=$e->id;

			$res=$d->responsedata(
				'subclasse',
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
				'subclasse',
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
	public function show($classe_id,$id)
	{
		$d=new ClassesubclasseData;
		return $d->show($id);

	}

	public function showvisible($classe_id,$id)
	{
		$d=new ClassesubclasseData;

		try {
			if (Subclasse::whereId($id)->count()==0) {
				$res=$d->responsedata(
					'subclasse',
					false,
					'show',
					$d->noexist
					)
				;
				$res=json_encode($res);
				throw new Exception($res);
			}
			$data=array(
				'subclasse'	=>$d->show($id),
				'header'	=>$d->header(),
				'classe_id' =>$classe_id,
				'id'		=>$id
				)
			;
			return View::make('tempviews.ClasseSubclasse.show',$data);

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
	public function edit($classe_id,$id)
	{
		$d=new ClassesubclasseData;
		try {
			if (Subclasse::whereId($id)->count()==0) {
				$res=$d->responsedata(
					'subclasse',
					false,
					'edit',
					$d->noexist
					)
				;
				$res=json_encode($res);
				throw new Exception($res);
			}
			$data=array(
				'subclasse'	=>$d->show($id),
				'header'	=>$d->header(),
				'classe_id'	=>$classe_id,
				'id'		=>$id
				)
			;
			return View::make('tempviews.ClasseSubclasse.edit',$data);
			
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
	public function update($classe_id,$id)
	{
		//instantiate fake user (for empresa and sessao)
		//SHOULD BE DELETED IN ORIGINAL PROJECT
		$fake=new fakeuser;

		$d=new ClassesubclasseData;
		$success=$d->formatdata();

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

			$e=Subclasse::find($id);
			foreach ($success as $key => $value) {
				$e->$key 	=$value;
			}
			$e->dthr_cadastro=date('Y-m-d');
			$e->sessao_id		=$fake->sessao_id();
			$e->save();	

			//response structure required for angularjs
			$res=$d->responsedata(
				'subclasse',
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
				'subclasse',
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
	public function destroy($classe_id,$id)
	{
		$d=new ClassesubclasseData;

		try{
			if (Subclasse::whereId($id)->count()==0) {
				throw new Exception(json_encode($d->noexist));
				$code=400;
			}

			Subclasse::whereId($id)->delete();
			$res=$d->responsedata(
				'subclasse',
				true,
				'delete',
				array('msg' => 'Registro excluído com sucesso!')
				)
			;
			$code=200;

		}
		catch(Exception $e){
			SysAdminHelper::NotifyError($e->getMessage());
			$res=$d->responsedata(
				'subclasse',
				false,
				'delete',
				array('msg' => json_decode($e->getMessage()))
				)
			;
			$code=400;
		}

		return Response::json($res,$code);
	}

	/**
	*-------------------------------------------------
	* actions for subcategorias route
	*-------------------------------------------------
	* "Categorias" route is required for two purposes
	* 1. Retrieving a JSON object containing data related
	*    to classe and subclasse tables
	* 2. Posting new categorias, this is, subclasse 
	*    features (data) related to the classe 'manutenção'
	*    (classe_id=2)
	*
	* Route '/categorias' uses three methods
	* @categorias : JSON object with all 'manutenção'
	*				subclasses (where Classe_id==2).
	* @categorias/create : 
	*				form for adding a new subclass
	*				with class_id = 2
	*
	* @store : 		same store action inside
	*				Classesubclassecontroller.
	*
	*/

	public function categorias () {
		$d=new ClassesubclasseData;
		$subclasse=$d->edata(2);
		$classe_header=array(
			'id',
			'nome',
			'descricao',
			'status'
			)
		;
		$subclasse_header=array(
			'id',
			'nome',
			'detalhe',
			'status'
			)
		;
		$categorias=array();
		foreach ($subclasse as $key => $value) {
			foreach ($classe_header as $v) {
				$categorias[$value->id]['classe_'.$v]=$value->Classe->$v;
			}
			foreach ($subclasse_header as $v) {
				$categorias[$value->id]['subclasse_'.$v]=$value->$v;
			}
			
		}
		/*foreach ($subclasse as $k => $v) {
			//
			;
		}*/
		return $categorias;
	}

}
