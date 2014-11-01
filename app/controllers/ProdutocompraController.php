<?php

class ProdutocompraData extends StandardResponse{
	public function header(){
		$header=array(	
			array('produtofatura_id',1)
			,array('quantidade',1)
			,array('produto_id',1)
			//,array('session_id',0)
			)
		;	
		return $header;
	}

	/**
	* @return edata retrieves all "fatura" related to "convenio"
	*/
	public function edata(){
		return Produtocompra::all();
	}

	public function show ($id) {
		return Produtocompra::find($id);
	}

	public function formatdata(){
		$formdata=array(
			'produtofatura_id'	=>Input::get('produtofatura_id'),
			'quantidade'			=>Input::get('quantidade'),
			'produto_id'		=>Input::get('produto_id')
			)
		;
		return $formdata;
	}

	public function validrules() {
		return array(
			'produtofatura_id' 	=>	'required'
			,'quantidade' 			=>	'required'
			,'produto_id' 		=>	'required'
			)
		;
	}

}

class ProdutocompraController extends \BaseController {

	public function __construct(){
		$this->beforeFilter('csrf', array('on' => 'post'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$d=new ProdutocompraData;
		return $d->edata();
	}

	public function visible()
	{
		$d=new ProdutocompraData;
		$header=$d->header();
		$produtocompra=$d->edata();
		return View::make(
			'tempviews.produtocompra.index',
			compact(
				'header',
				'produtocompra'
				)
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
		return View::make(
			'tempviews.produtocompra.create'
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
		//disabled
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$d=new ProdutocompraData;
		return $d->show($id);
	}

	public function showvisible($id)
	{
		$d=new ProdutocompraData;
		$header=$d->header();
		$produtocompra=$d->show($id);
		return View::make(
			'tempviews.produtocompra.show',
			compact(
				'header',
				'produtocompra',
				'id'
				)
			)
		;
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$d=new ProdutocompraData;
		
		$produtocompra=$d->show($id);
		return View::make(
			'tempviews.produtocompra.edit',
			compact(
				'produtocompra',
				'id'
				)
			)
		;
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

		$d=new ProdutocompraData;

		$success=$d->formatdata();

		try {
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

			$e=Produtocompra::find($id);
			foreach ($success as $key => $value) {
				$e->$key 	=$value;
			}
			$e->save();	

			//response structure required for angularjs
			$res=$d->responsedata(
				'produtocompra',
				true,
				'update',
				$success
				)
			;
			$code=200;
		}
		catch (Exception $e) {
			SysAdminHelper::NotifyError($e->getMessage());
			$res=$d->responsedata(
				'produtocompra',
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
