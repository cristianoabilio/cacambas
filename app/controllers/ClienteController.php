<?php
/**
 * [Table]Data class only contains data related to
 * the table 
 */
class ClienteData extends StandardResponse{

	//more simplified data arrangement

	public $cacambasData=array(
		//structure must follow next syntax convention for each value
		// 'field_name,1/0[visible_on_index],1/0[0=skip;1=fillable;2=nullable],valid_rules'
		'login_id,0,2,'
		,'cpf/cnpj,0,2,'
		,'pj,0,1,required'
		,'nome,1,1,required'
		,'tipo_cliente,0,2,'
		,'tipo_pagamento,0,1,required'
		,'forma_pagamento,0,1,required'
		,'total_pago,0,2,'
		,'badge,0,2,'
		)
	;
	
	/**
	* @param edata retrieves all data from table "empresa"
	*/
	public function edata () {
		return Cliente::all();
	}

	public function show($id){
		return Cliente::find($id);
	}
}

class ClienteController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$d=new ClienteData;
		return Response::json($d->edata());
	}

	public function visible () {
		$d=new ClienteData;
		$data=array(
			//all cliente
			'cliente'=>$d->edata(),
			'header'=>$d->head($d->cacambasData)
			)
		;

		//
		return View::make(
			'tempviews.cliente.index'
			,$data
			)
		;
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('tempviews.cliente.create');
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

		$d=new ClienteData;
		$success=$d->form_data_fixed($d->cacambasData);

		try{
			$validator= Validator::make(			
				Input::All(),
				$d->valid_rules($d->cacambasData),	
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

			$e=new Cliente;	
			foreach ($success as $key => $value) {
				$e->$key 	=$value;
			}
			$e->status=1;
			$e->save();

			$success['id']=$e->id;

			$res=$d->responsedata(
				'cliente',
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
				'cliente',
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
		$d=new ClienteData;
		return $d->show($id);
	}

	public function showvisible ($id) {
		$d=new ClienteData;
		try {
			if (Cliente::whereId($id)->count()==0) {
				$res=$d->responsedata(
					'cliente',
					false,
					'show',
					$d->noexist
					)
				;
				$res=json_encode($res);
				throw new Exception($res);
			}
			$data=array(
				'cliente'	=>$d->show($id),
				'header'	=>$d->head($d->cacambasData),
				'id'		=>$id
				)
			;
			return View::make('tempviews.cliente.show',$data);
			
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
		$d=new ClienteData;
		try {
			if (Cliente::whereId($id)->count()==0) {
				$res=$d->responsedata(
					'cliente',
					false,
					'edit',
					$d->noexist
					)
				;
				$res=json_encode($res);
				throw new Exception($res);
			}
			$data=array(
				'cliente'	=>$d->show($id),
				'header'	=>$d->head($d->cacambasData),
				'id'		=>$id
				)
			;
			return View::make('tempviews.cliente.edit',$data);
			
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

		$d=new ClienteData;
		$success=$d->form_data_fixed($d->cacambasData);

		try{
			$validator= Validator::make(			
				Input::All(),	
				$d->valid_rules($d->cacambasData),	
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

			$e=Cliente::find($id);
			foreach ($success as $key => $value) {
				$e->$key 	=$value;
			}
			$e->save();	

			//response structure required for angularjs
			$res=$d->responsedata(
				'cliente',
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
				'cliente',
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
		//
	}


}
