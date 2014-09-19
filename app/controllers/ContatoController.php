<?php

class ContatosController extends BaseController {

	protected $layout = 'templates.main';

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $data = array('contatos' => $contatos);

        return $this->layout->content = View::make('contatos.list',$data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$data = array('action' => 'add');
        return $this->layout->content = View::make('contatos.form',$data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		try{

			$r = new Contato;
			$r->cliente_id = Input::get('nome');
			$r->tipo = Input::get('tipo');
			$r->contato = Input::get('contato');
			$r->dthr_cadastro = date('Y-m-d H:i:s');
			$r->sessao_id = null;
			$r->status = null;

			$r->save();

			$res = array('status'=>'success','msg' => 'Registro salvo com sucesso!');

		}catch(Exception $e){

			SysAdminHelper::NotifyError($e->getMessage);

			$res = array('status'=>'error','msg' => $e->getMessage());

		}


		return Response::json($res);

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	// public function show($id)
	// {
 //        return View::make('contatos.show');
	// }

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$data = array('action' => 'update');
        return $this->layout->content = View::make('contatos.form',$data);
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

			$r = Contato::findOrFail($id);

			$r->cliente_id = Input::get('nome');
			$r->tipo = Input::get('tipo');
			$r->contato = Input::get('contato');
			$r->dthr_cadastro = date('Y-m-d H:i:s');
			$r->sessao_id = null;
			$r->status = null;

			$r->save();

			$res = array('status'=>'success','msg' => 'Registro atualizado com sucesso!');

		}catch(Exception $e){

			SysAdminHelper::NotifyError($e->getMessage);

			$res = array('status'=>'error','msg' => $e->getMessage());

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

			$r = Contato::findOrFail($id);
			$r->delete();

			$res = array('status'=>'success','msg' => 'Registro excluído com sucesso!');

		}catch(Exception $e){

			SysAdminHelper::NotifyError($e->getMessage);

			$res = array('status'=>'error','msg' => $e->getMessage());

		}

		return Response::json($res);
	}

}
