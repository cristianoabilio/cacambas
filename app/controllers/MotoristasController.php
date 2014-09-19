<?php
class MotoristasController extends BaseController {

	protected $layout = 'templates.main';

	public function index()
	{
		$data = array('motoristas' => $motoristas);

		return $this->layout->content = View::make('motorista.list',$data);
	}


	public function create()
	{
		$data = array('action' => 'add');
		return $this->layout->content = View::make('motorista.form',$data);
	}


	public function store()
	{

		try{


			$validator = Validator::make(
			                             Input::All(),
			                             array(
			                                   'nome' => 'required',
			                                   'funcao' => 'required',
			                                   'status' => 'required',
			                                   'telefone' => 'required'
			                                   ),
			                             array(
			                                   'required' => 'Preencha o campo :attribute.',
			                                   )
			                             );

			if ($validator->fails())
				throw new Exception(json_encode(array('validation_errors'=>$validator->messages()->all())));

			$r = new Funcionario;
			$r->nome = Input::get('nome');
			$r->funcao = Input::get('funcao');//motorista
			$r->status = Input::get('status');
			$r->telefone = Input::get('telefone');
			$r->dthr_cadastro = date('Y-m-d H:i:s');
			$r->sessao_id = $this->id_sessao;

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
		return $this->layout->content = View::make('motorista.form',$data);
	}


	public function update()
	{
		try{

			$validator = Validator::make(
			                             Input::All(),
			                             array(
			                                   'id' => 'required',
			                                   'nome' => 'required',
			                                   'funcao' => 'required',
			                                   'status' => 'required',
			                                   'telefone' => 'required'
			                                   ),
			                             array(
			                                   'required' => 'Preencha o campo :attribute.',
			                                   )
			                             );

			if ($validator->fails())
				throw new Exception(json_encode(array('validation_errors'=>$validator->messages()->all())));

			$r = Funcionario::findOrFail(Input::get('id'));

			$r->nome = Input::get('nome');
			$r->funcao = Input::get('funcao');//motorista
			$r->status = Input::get('status');
			$r->telefone = Input::get('telefone');
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

			$r = Funcionario::findOrFail(Input::get('id'));
			$r->delete();

			$res = array('status'=>'success','msg' => 'Registro excluído com sucesso!');

		}catch(Exception $e){

			SysAdminHelper::NotifyError($e->getMessage());

			$res = array('status'=>'error','msg' => json_decode($e->getMessage()));

		}

		return Response::json($res);
	}

}
