<?php
/**
 * [Table]Data class only contains data related to
 * the table 
 */
class EmpresaClienteData extends StandardResponse{

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
	public function edata ($empresa_id) {
		return Empresa::find($empresa_id)->cliente;
	}

	public function show($id){
		return Cliente::find($id);
	}
}

class EmpresaClienteController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($empresa_id)
	{
		$d=new EmpresaClienteData;
		return Response::json($d->edata($empresa_id));
	}

	public function visible($empresa_id)
	{
		$d=new EmpresaClienteData;
		//
		$cliente=$d->edata($empresa_id);
		$header=$d->head($d->cacambasData);

		//
		return View::make(
			'tempviews.EmpresaCliente.index'
			,compact(
				'empresa_id',
				'cliente',
				'header'
				)
			)
		;
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($empresa_id)
	{
		return View::make('tempviews.EmpresaCliente.create',
			compact('empresa_id')
			)
		;
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($empresa_id)
	{
		//instantiate fake user (for empresa and sessao)
		//SHOULD BE DELETED IN ORIGINAL PROJECT
		$fake=new fakeuser;
		//

		$d=new EmpresaClienteData;
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
			$e->empresa_id=$empresa_id;
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
	public function show($empresa_id,$id)
	{
		$d=new EmpresaClienteData;
		return $d->show($id);
	}

	public function showvisible($empresa_id,$id)
	{
		$d=new EmpresaClienteData;
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
				'id'		=>$id,
				'empresa_id'=>$empresa_id
				)
			;
			return View::make('tempviews.EmpresaCliente.show',$data);
			
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
		$d=new EmpresaClienteData;
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
				'empresa_id'=>$empresa_id,
				'id'		=>$id
				)
			;
			return View::make('tempviews.EmpresaCliente.edit',$data);
			
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
		//instantiate fake user (for empresa and sessao)
		//SHOULD BE DELETED IN ORIGINAL PROJECT
		$fake=new fakeuser;

		$d=new EmpresaClienteData;
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
	public function destroy($empresa_id,$id)
	{
		//
	}


}
