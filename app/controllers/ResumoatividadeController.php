<?php
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
			,array('data',1)			
			,array('total_os_colocada',1)			
			,array('total_os_retirada',1)
			,array('total_os_troca',1)			
			,array('total_colocada',1)
			,array('total_retirada',1)
			,array('total_troca',1)
			,array('km_percorrida',1)
		);				
		return $header;				
	}					
						
	/**					
	* @param edata retrieves all data from table "empresa"					
	*/
	public function edata () {					
		return resumoatividade::all();			
	}	

	public function show ($id) {
		return resumoatividade::find($id);
	}

	/**
	* @param formdata returns array with form values
	*/
	public function form_data(){

		$formdata= array(
			'funcionario_id'	=>Input::get('funcionario_id'),
			'data'				=>Input::get('data'),
			'empresa_id'		=>Input::get('empresa_id'),
			'total_os_colocada'	=>Input::get('total_os_colocada'),
			'total_os_troca'	=>Input::get('total_os_troca'),
			'total_os_retirada'	=>Input::get('total_os_retirada'),
			'total_colocada'	=>Input::get('total_colocada'),
			'total_retirada'	=>Input::get('total_retirada'),
			'total_troca'		=>Input::get('total_troca'),
			'km_percorrida'		=>Input::get('km_percorrida'),
			)
		;

		$nullable=array(
			//'login_id'	=>Input::get('login_id')
			)
		;
		foreach ($nullable as $key => $value) {
			if ( trim($value)!="" ) {
				$formdata[$key]=$value;
			} else {
				$formdata[$key]=null;
			}
		}


		return $formdata;
	}

	public function validrules(){
		return array(
			//'funcionario_id'		=>	'required'
			//,'mes_referencia'	=>	'required'
			//,'ano_referencia'	=>	'required'
			// ,'dthr_cadastro'=> timestamp, not required
			// ,'sessao_id'=> sessao, not required
			)
		;
	}

}

class ResumoatividadeController extends \BaseController {

	public function __construct(){
		//$this->beforeFilter('csrf', array('on' => 'post'));
	}



	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index () {
		$d=new resumoatividadeData;
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
	public function visible () {
		
		$d=new resumoatividadedata;
		$data=array(
			'resumoatividade'=>$d->edata(),
			'header'=>$d->header()
			)
		;
		return View::make('tempviews.resumoatividade.index',$data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$data=array();
		return View::make('tempviews.resumoatividade.create',$data);
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

		$d=new resumoatividadedata;
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

			$e=new Resumoatividade;	
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
	public function show($id)
	{
		$d=new ResumoatividadeData;
		return $d->show($id);
	}

	public function showvisible ($id) {
		//resumoatividadedata
		$d=new ResumoatividadeData;
		$data=array(
			'resumoatividade'	=>$d->show($id),
			'header'	=>$d->header(),
			'id'		=>$id
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
	public function edit($id)
	{
		//resumoatividadedata
		$d=new resumoatividadedata;
		$data=array(
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
	public function update($id)
	{
		//instantiate fake user (for empresa and sessao)
		//SHOULD BE DELETED IN ORIGINAL PROJECT
		$fake=new fakeuser;

		$d=new resumoatividadedata;
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

			$e=Resumoatividade::find($id);
			foreach ($success as $key => $value) {
				$e->$key 	=$value;
			}
			$e->save();	

			//response structure required for angularjs
			$res=$d->responsedata(
				'resumoatividade',
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
				'resumoatividade',
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
	}*/
}

	


//}
