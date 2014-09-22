<?php
/**						
* resumoatividadedata class only contains data related to						
 * the table resumoatividade						
 */						
class ResumoatividadeData extends StandardResponse{						
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
			array('funcionario_id',0)			
			,array('empresa_id',0)			
			,array('mes_referencia',1)			
			,array('ano_referencia',1)			
			,array('total_os_colocada',1)			
			,array('total_os_troca',0)			
			,array('total_os_retirada',0)			
		);				
		return $header;				
	}					
						
	/**					
	* @param edata retrieves all data from table "empresa"					
	*/
	public function edata ($funcionario) {					
		return Funcionario::find($funcionario)->resumoatividade;				
	}					
						
	public function show($id){					
		return Resumoatividade::find($id);				
	}					
						
	/**					
	* @param formdata returns array with form values					
	*/					
	public function formatdata(){					
						
		return array(
			'mes_referencia'		=>Input::get('mes_referencia'),
			'ano_referencia'		=>Input::get('ano_referencia'),
			'total_os_colocada'		=>Input::get('total_os_colocada'),
			'total_os_troca'		=>Input::get('total_os_troca'),
			'total_os_retirada'		=>Input::get('total_os_retirada')
			)
		;
	}

	public function validrules(){
		return array(
			'mes_referencia'	=>	'required'
			,'ano_referencia'	=>	'required'
			,'total_os_colocada'=>	'required'
			,'total_os_troca'	=>	'required'
			,'total_os_retirada'=>	'required'

			)
		;
	}
}						



class FuncionarioResumoatividadeController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($id)
	{
		$e=Funcionario::find($id);
		$fake=new fakeuser;
		$d=new ResumoatividadeData;
		$data=array(
			//all compras
			'funcionario'=>$e,
			'resumoatividade'=>$d->edata($id ),
			'header'=>$d->header()
			)
		;

		return //$e->Resumoatividade
		View::make('tempviews.resumoatividade.index',$data);
		;
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($id)
	{
		$data=array(
			'funcionario'=>Funcionario::find($id)
			)
		;
		return View::make('tempviews.resumoatividade.create',$data);
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
		//

		$d=new ResumoatividadeData;
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

			$e=new Resumoatividade;	
			$e->funcionario_id=$id;
			foreach ($success as $key => $value) {
				$e->$key 	=$value;
			}
			$e->empresa_id= $fake->empresa();
			
			$e->save();	

			$res=$d->responsedata(
				'resumoatividade',
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
				'resumoatividade',
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
	public function show($funcionario,$id)
	{
		//$func=Funcionario::find($funcionario);
		$d=new ResumoatividadeData;$data=array(
			'funcionario'=>Funcionario::find($funcionario),
			'resumoatividade'	=>$d->show($id),
			'header'			=>$d->header(),
			'id'				=>$id
			)
		;
		return View::make('tempviews.resumoatividade.show',$data);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($funcionario,$id)
	{
		$d=new ResumoatividadeData;$data=array(
			'funcionario'=>Funcionario::find($funcionario),
			'resumoatividade'	=>$d->show($id),
			'header'			=>$d->header(),
			'id'				=>$id
			)
		;
		return View::make('tempviews.resumoatividade.edit',$data);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($funcionario,$id)
	{
		//instantiate fake user (for empresa and sessao)
		//SHOULD BE DELETED IN ORIGINAL PROJECT
		$fake=new fakeuser;

		$d=new ResumoatividadeData;
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

			$e=Resumoatividade::find($id);
			$e->funcionario_id=$funcionario;
			//
			foreach ($success as $key => $value) {
				$e->$key 	=$value;
			}
			$e->save();	

			//response structure required for angularjs
			$res=$d->responsedata(
				'Resumoatividade',
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
				'Resumoatividade',
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