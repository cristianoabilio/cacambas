<?php

/**
 * [Table]Data class only contains data related to
 * the table 
 */
class EstadoData extends StandardResponse{
	public $estadoparam=array(
		'nome,1,1,required'
		,'regiao,1,2,'
		)
	;
	
	/**
	* @param edata retrieves all data from table "empresa"
	*/
	public function edata () {
		return Estado::all();
	}

	public function show($id){
		return Estado::find($id);
	}

}

class EstadoController extends \BaseController {

	public function __construct(){
		//$this->beforeFilter('csrf', array('on' => 'post'));
		//$this->beforeFilter('geoendereco');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index () {
		$d=new EstadoData;
		return Response::json($d->edata());
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
	public function visible()
	{
		$d=new EstadoData;
		$data=array(
			//all estado
			'estado'=>$d->edata(),
			'header'=>$d->head($d->estadoparam)
			)
		;
		return View::make('tempviews.estado.index',$data);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$data=array();
		return View::make('tempviews.estado.create',$data);
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
		$fake=new fakeuser;
		//

		$d=new EstadoData;
		$success=$d->form_data_fixed($d->estadoparam);

		try{
			$validator= Validator::make(			
				Input::All(),
				$d->valid_rules($d->estadoparam),
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

			$e=new Estado;	
			foreach ($success as $key => $value) {
				$e->$key 	=$value;
			}
			$e->save();

			$success['id']=$e->id;

			$res=$d->responsedata(
				'estado',
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
				'estado',
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
	public function show ($id) {
		$d=new EstadoData;
		return $d->show($id);
	}
	public function showvisible($id)
	{
		$d=new EstadoData;
		try {
			if (Estado::whereId($id)->count()==0) {
				$res=$d->responsedata(
					'estado',
					false,
					'show',
					$d->noexist
					)
				;
				$res=json_encode($res);
				throw new Exception($res);
			}
			$data=array(
				'estado'	=>$d->show($id),
				'header'	=>$d->head($d->estadoparam),
				'id'		=>$id
				)
			;
			return View::make('tempviews.estado.show',$data);
			
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
		$d=new EstadoData;
		try {
			if (Estado::whereId($id)->count()==0) {
				$res=$d->responsedata(
					'estado',
					false,
					'edit',
					$d->noexist
					)
				;
				$res=json_encode($res);
				throw new Exception($res);
			}
			$data=array(
				'estado'	=>$d->show($id),
				'header'	=>$d->head($d->estadoparam),
				'id'		=>$id
				)
			;
			return View::make('tempviews.estado.edit',$data);
			
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
		//instantiate fake user (for empresa and sessao)
		//SHOULD BE DELETED IN ORIGINAL PROJECT
		$fake=new fakeuser;

		$d=new EstadoData;
		$success=$d->form_data_fixed($d->estadoparam);

		try{
			$validator= Validator::make(			
				Input::All(),	
				$d->valid_rules($d->estadoparam),
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

			$e=Estado::find($id);
			foreach ($success as $key => $value) {
				$e->$key 	=$value;
			}
			$e->save();	

			//response structure required for angularjs
			$res=$d->responsedata(
				'estado',
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
				'estado',
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
	/*public function destroy($id)
	{
		//
	}
*/

}
