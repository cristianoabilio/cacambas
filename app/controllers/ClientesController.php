<?php

class ClientesController extends BaseController {

	protected $layout = 'templates.main';

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data = array('clientes' => $clientes);

		return $this->layout->content = View::make('cliente.list',$data);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$data = array('action' => 'add');
		return $this->layout->content = View::make('cliente.form',$data);
	}


	public function view($id){

		try{

			$res = Cliente::findOrFail($id);

		}catch(Exception $e){

			SysAdminHelper::NotifyError($e->getMessage());

			$res = array('status'=>'error','msg' => json_decode($e->getMessage()));

		}

		return Response::json($res);
	}


	public function sendPassword($id){

		try{

			$cliente = Cliente::findOrFail($id);

			$login = $cliente->Login;
			$login->senha = Hash::make(str_random(6));
			$login->save();

			Mail::send('emails.clientes.sendPassword',
			           array(
			           	'nome' => $cliente->nome,
			           	'email' => $login->email,
			           	'password' => $login->senha,
			           ),
			function($message){
			    $message->to($login->email, $cliente->nome)->subject('Sua nova senha');
			});

			$res = $cliente;

		}catch(Exception $e){

			SysAdminHelper::NotifyError($e->getMessage());

			$res = array('status'=>'error','msg' => json_decode($e->getMessage()));

		}

		return Response::json($res);
	}




	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		try{
			$login_id = Input::get('login_id',null);
			$cpf_cnpj = Input::get('cpf_cnpj',null);
			$pj = Input::get('pj',null);
			$nome = Input::get('nome',null);
			$forma_pagamento = Input::get('forma_pagamento',null);


			$validator = Validator::make(
			                             array(
			                                   Input::All()
			                                   ),
			                             array(
			                                   'login_id' => 'required',
			                                   'cpf_cnpj' => 'required',
			                                   'pj' => 'required',
			                                   'nome' => 'required',
			                                   ),
			                             array(
			                                   'required' => 'Preencha o campo :attribute.',
			                                   )
			                             );

			if ($validator->fails())
				throw new Exception(json_encode(array('validation_errors'=>$validator->messages()->all())));


			$r = new Cliente;
			$r->login_id = $login_id;
			$r->cpf_cnpj = $cpf_cnpj;
			$r->pj = $pj;
			$r->nome = $nome;
			$r->forma_pagamento = $forma_pagamento;
			$r->dthr_cadastro = date('Y-m-d H:i:s');
			$r->sessao_id = $this->id_sessao;

			$r->save();

			$this->addAddress($r);

			$res = array('status'=>'success','msg' => 'Registro salvo com sucesso!');

		}catch(Exception $e){

			SysAdminHelper::NotifyError($e->getMessage());

			$res = array('status'=>'error','msg' => json_decode($e->getMessage()));

		}

		return Response::json($res);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$data = array('action' => 'update');
		return $this->layout->content = View::make('cliente.form',$data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update()
	{
		try{

			$id = Input::get('id',null);
			$login_id = Input::get('login_id',null);
			$cpf_cnpj = Input::get('cpf_cnpj',null);
			$pj = Input::get('pj',null);
			$nome = Input::get('nome',null);
			$forma_pagamento = Input::get('forma_pagamento',null);
			


			$validator = Validator::make(
			                             array(
			                                   Input::All()
			                                   ),
			                             array(
			                                   'id' => 'required',
			                                   'login_id' => 'required',
			                                   'cpf_cnpj' => 'required',
			                                   'pj' => 'required',
			                                   'nome' => 'required',
			                                   ),
			                             array(
			                                   'required' => 'Preencha o campo :attribute.',
			                                   )
			                             );

			if ($validator->fails())
				throw new Exception(json_encode(array('validation_errors'=>$validator->messages()->all())));


			$r = Cliente::findOrFail($id);

			$r->login_id = $login_id;
			$r->cpf_cnpj = $cpf_cnpj;
			$r->pj = $pj;
			$r->nome = $nome;
			$r->forma_pagamento = $forma_pagamento;
			$r->sessao_id = $this->id_sessao;

			$r->save();

			$res = array('status'=>'success','msg' => 'Registro atualizado com sucesso!');

		}catch(Exception $e){

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
	public function destroy()
	{
		try{

			$id = Input::get('id',null);

			$validator = Validator::make(
			                             array(
			                                   'id' => $id
			                                   ),
			                             array(
			                                   'id' => 'required'
			                                   ),
			                             array(
			                                   'required' => 'Preencha o campo :attribute.',
			                                   )
			                             );

			if ($validator->fails())
				throw new Exception(json_encode(array('validation_errors'=>$validator->messages()->all())));

			$r = Cliente::findOrFail($id);
			$r->delete();

			$res = array('status'=>'success','msg' => 'Registro excluído com sucesso!');

		}catch(Exception $e){

			SysAdminHelper::NotifyError($e->getMessage());

			$res = array('status'=>'error','msg' => json_decode($e->getMessage()));

		}

		return Response::json($res);
	}


	/**
	 * Add an address to customer
	 */
	protected function addAddress($cliente){


		$tipo = Input::get('tipo',null);
		$complemento = Input::get('complemento',null);
		$observacao = Input::get('observacao', null);
		$dthr_cadastro = date("Y-m-d H:i:s");
		$status = Input::get('status', 1);


		try{


			$estado = Estado::firstOrCreate(array('nome'=>Input::get('estado', null)));

			$cidade = Cidade::firstOrCreate(array(
			                                'name'=>Input::get('cidade', null),
			                                'estado'=>$estado->id
			                                ));

			$bairro = Bairro::firstOrCreate(array(
			                                'nome'=>Input::get('bairro', null),
			                                'zona'=>Input::get('zona', null),
			                                'cidade_id' => $cidade->id,
			                                'estado_id' => $estado->id
			                                ));

			$enderecoBase = Enderecobase::firstOrCreate(array(
			                                            'bairro_id' => $bairro->id,
			                                            'cidade_id' => $cidade->id,
			                                            'estado_id' => $estado->id,
			                                            'cep' => Input::get('cep', null),
			                                            'logradouro' => Input::get('logradouro', null),
			                                            'regiao' => Input::get('regiao', null),
			                                            'restricao_hr_inicio' => Input::get('restricao_hr_inicio', null),
			                                            'restricao_hr_fim' => Input::get('restricao_hr_fim', null),
			                                            'numero_inicio' => Input::get('numero_inicio', null),
			                                            'numero_fim' => Input::get('numero_fim', null)
			                                            ));
			$enderecoBase->dthr_cadastro = $dthr_cadastro;
			$enderecoBase->sessao_id = $this->id_sessao;
			$enderecoBase->save();

			$endereco = Endereco::firstOrCreate(array(
			                                    'enderecobase_id' => $enderecoBase->id,
			                                    'numero' => Input::get('numero',null),
			                                    'latitude' => Input::get('latitude',null),
			                                    'longitude' => Input::get('longitude',null),
			                                    'restricao_hr_inicio' => Input::get('restricao_hr_inicio',null),
			                                    'restricao_hr_fim' => Input::get('restricao_hr_fim',null),
			                                    'dthr_cadastro' => Input::get('dthr_cadastro',null),
			                                    'sessao_id' => $this->id_sessao,
			                                    ));


			$r = new Enderecocliente;

			$r->sessao_id = $this->id_sessao;
			$r->cliente_id = $cliente->id;
			$r->tipo =  $tipo;
			$r->complemento = $complemento;
			$r->observacao = $observacao;
			$r->dthr_cadastro = $dthr_cadastro;
			$r->status = $status;
			$r->sessao_id = $this->id_sessao;

			$r->EnderecoBase()->associate($enderecoBase);
			$r->Endereco()->associate($endereco);
			$r->Cliente()->associate($cliente);

			$r->save();

			$res = array('status'=>'success','msg' => 'Registro excluído com sucesso!');

		}catch(Exception $e){

			SysAdminHelper::NotifyError($e->getMessage());

			$res = array('status'=>'error','msg' => json_decode($e->getMessage()));

		}

		return Response::json($res);
	}

	public function getEnderecoCliente(){

		try{

			$id = Input::get('id',null);
			$endereco_id = Input::get('endereco_id',null);

			$cliente = Cliente::findOrFail($id);

			$res = $cliente->Enderecocliente()->where('id','=',$endereco_id)->first()->toArray();

		}catch(Exception $e){

			SysAdminHelper::NotifyError($e->getMessage());

			$res = array('status'=>'error','msg' => json_decode($e->getMessage()));

		}

		return Response::json($res);

	}

	public function getEnderecosCliente(){

		try{

			$id = Input::get('id',null);

			$cliente = Cliente::findOrFail($id);
			$enderecos = $cliente->Enderecocliente();
			$res = $enderecos::all()->toArray();

		}catch(Exception $e){

			SysAdminHelper::NotifyError($e->getMessage());

			$res = array('status'=>'error','msg' => json_decode($e->getMessage()));

		}

		return Response::json($res);

	}

}
