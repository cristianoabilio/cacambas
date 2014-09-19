<?php

class limitedata{
	/** 
	* function name: header.
	* @param header with headers of limite table
	*/
	public function header(){
		/*
		$enderecoheader= headers on table enderecos
		In order to display or hide on HTML table, set as
		1 (visible) or 2 (not shown)
		*/
		$limiteheader=array(	
			array('motoristas',1)
			,array('caminhoes',1)
			,array('rastreamento',0)
			,array('cacambas',0)
			,array('NFSe',0)
			,array('manutencao',0)
			,array('pagamentos',0)
			,array('fluxo_caixa',0)
			,array('relatorio_avancado',0)
			,array('benchmarks',0)
			,array('IDSessao',0)
			,array('dthr_cadastro',0)

			)
		;	
		return $limiteheader;
	}
	
	/**
	* @param edata retrieves all data from table "limite"
	*/
	public function edata () {
		return Limite::all();
	}

	public function show($id){
		return Limite::find($id);
	}
}

class LimiteController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$d=new limitedata;
		$data=array(
			//retrieve all "limite" rows
			'limite'=>$d->edata(),

			//retrieving table headers
			'header'=>$d->header()
			)
		;
		return View::make('tempviews.limite.index',$data);
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
			'tempviews.limite.create'
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
					'motoristas'=>	'required'
					,'caminhoes'=>	'required'
					,'rastreamento'=>	'required'
					,'cacambas'=>	'required'
					,'NFSe'=>	'required'
					,'manutencao'=>	'required'
					,'pagamentos'=>	'required'
					,'fluxo_caixa'=>	'required'
					,'relatorio_avancado'=>	'required'
					,'benchmarks'=>	'required'
					,'IDSessao'=>	'required'

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

			$e=new Limite;	
			$e->motoristas			=Input::get('motoristas');
			$e->caminhoes			=Input::get('caminhoes');
			$e->rastreamento		=Input::get('rastreamento');
			$e->cacambas			=Input::get('cacambas');
			$e->NFSe				=Input::get('NFSe');
			$e->manutencao			=Input::get('manutencao');
			$e->pagamentos			=Input::get('pagamentos');
			$e->fluxo_caixa			=Input::get('fluxo_caixa');
			$e->relatorio_avancado	=Input::get('relatorio_avancado');
			$e->benchmarks			=Input::get('benchmarks');
			$e->IDSessao			=Input::get('IDSessao');
			$e->dthr_cadastro		=date('Y-m-d H:i:s');
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
		$d=new limitedata;
		$data=array(
			'limite' 	=>$d->show($id),
			'header' 	=>$d->header(),
			'id' 		=>$id
			)
		;
		return View::make('tempviews.limite.show',$data);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$d=new limitedata;
		$data=array(
			'limite' 	=>$d->show($id),
			'header' 	=>$d->header(),
			'id' 		=>$id
			)
		;
		return View::make('tempviews.limite.edit',$data);
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
					'motoristas'=>	'required'
					,'caminhoes'=>	'required'
					,'rastreamento'=>	'required'
					,'cacambas'=>	'required'
					,'NFSe'=>	'required'
					,'manutencao'=>	'required'
					,'pagamentos'=>	'required'
					,'fluxo_caixa'=>	'required'
					,'relatorio_avancado'=>	'required'
					,'benchmarks'=>	'required'
					,'IDSessao'=>	'required'
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

			$e=Limite::find($id);	
			$e->motoristas			=Input::get('motoristas');
			$e->caminhoes			=Input::get('caminhoes');
			$e->rastreamento		=Input::get('rastreamento');
			$e->cacambas			=Input::get('cacambas');
			$e->NFSe				=Input::get('NFSe');
			$e->manutencao			=Input::get('manutencao');
			$e->pagamentos			=Input::get('pagamentos');
			$e->fluxo_caixa			=Input::get('fluxo_caixa');
			$e->relatorio_avancado	=Input::get('relatorio_avancado');
			$e->benchmarks			=Input::get('benchmarks');
			$e->IDSessao			=Input::get('IDSessao');
			$e->dthr_cadastro		=date('Y-m-d H:i:s');
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
			Limite::where('IDLimite','=',$id)->delete();
			$res = array('status'=>'success','msg' => 'Registro excluído com sucesso!');
		}
		catch(Exception $e){
			SysAdminHelper::NotifyError($e->getMessage());
			$res = array('status'=>'error','msg' => json_decode($e->getMessage()));
		}

		return Response::json($res);
	}


}
