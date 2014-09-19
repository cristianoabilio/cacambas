<?php

class EmpresasController extends BaseController {

	protected $layout = 'templates.main';


	public function index()
	{
		$data = array('empresas' => $empresas);

		return $this->layout->content = View::make('empresa.list',$data);
	}


	public function create()
	{
		$data = array('action' => 'add');
		return $this->layout->content = View::make('empresa.form',$data);
	}


	public function store()
	{

		try{

			$validator = Validator::make(
			                             Input::All(),
			                             array(
			                                   'nome' => 'required',
			                                   'nome_fantasia' => 'required',
			                                   'responsavel'=> 'required',
			                                   'email'=> 'required',
			                                   'telefone' => 'required'
			                                   ),
			                             array(
			                                   'required' => 'Preencha o campo :attribute.',
			                                   )
			                             );

			if ($validator->fails())
				throw new Exception(json_encode(array('validation_errors'=>$validator->messages()->all())));


			$r = new Empresa;
			$r->nome = Input::get('nome');
			$r->nome_fantasia = Input::get('nome_fantasia');
			$r->cnpj = Input::get('cnpj');
			$r->responsavel = Input::get('responsavel');
			$r->email = Input::get('email');
			$r->telefone = Input::get('telefone');
			$r->celular = Input::get('celular',null);
			$r->observacoes = Input::get('observacoes',null);
			$r->status = Input::get('status');
			$r->sessao_id = $this->id_sessao;
			$r->dthr_cadastro = date('Y-m-d H:i:s');
			$r->save();

			$res = array('status'=>'success','msg' => 'Registro salvo com sucesso!');

		}catch(Exception $e){

			SysAdminHelper::NotifyError($e->getMessage());

			$res = array('status'=>'error','msg' => json_decode($e->getMessage()));

		}


		return Response::json($res);

	}


	public function edit($id)
	{
		$data = array('action' => 'update');
		return $this->layout->content = View::make('empresa.form',$data);
	}


	public function update()
	{
		try{

			$validator = Validator::make(
			                             Input::All(),
			                             array(
			                                   'id' => 'required',
			                                   'nome' => 'required',
			                                   'nome_fantasia' => 'required',
			                                   'responsavel'=> 'required',
			                                   'email'=> 'required',
			                                   'telefone' => 'required'
			                                   ),
			                             array(
			                                   'required' => 'Preencha o campo :attribute.',
			                                   )
			                             );

			if ($validator->fails())
				throw new Exception(json_encode(array('validation_errors'=>$validator->messages()->all())));

			$r = Empresa::findOrFail($id);

			$r->nome = Input::get('nome');
			$r->nome_fantasia = Input::get('nome_fantasia');
			$r->cnpj = Input::get('cnpj');
			$r->responsavel = Input::get('responsavel');
			$r->email = Input::get('email');
			$r->telefone = Input::get('telefone');
			$r->celular = Input::get('celular',null);
			$r->observacoes = Input::get('observacoes',null);
			$r->status = Input::get('status');
			$r->sessao_id = $this->id_sessao;

			$r->save();

			$res = array('status'=>'success','msg' => 'Registro atualizado com sucesso!');

		}catch(Exception $e){

			SysAdminHelper::NotifyError($e->getMessage());

			$res = array('status'=>'error','msg' => json_decode($e->getMessage()));

		}

		return Response::json($res);
	}


	public function destroy()
	{
		try{

			$validator = Validator::make(
			                             Input::All(),
			                             array('id' => 'required'),
			                             array('required' => 'Preencha o campo :attribute.')
			                             );

			if ($validator->fails())
				throw new Exception(json_encode(array('validation_errors'=>$validator->messages()->all())));

			$r = Empresa::findOrFail(Input::get('id'));
			$r->delete();

			$res = array('status'=>'success','msg' => 'Registro excluído com sucesso!');

		}catch(Exception $e){

			SysAdminHelper::NotifyError($e->getMessage());

			$res = array('status'=>'error','msg' => json_decode($e->getMessage()));

		}

		return Response::json($res);
	}

}
