<?php

class LocacoesController extends BaseController {

	protected $aluguel, $tarefa,$contrato;

	public function store(){

		try{

			$aluguel = $this->storeAluguel();

			$tarefa = $this->storeTarefa();

			$res = array(
			             'aluguel' => $aluguel,
			             'tarefa' => $tarefa
			             );

		}catch(Exception $e){

			SysAdminHelper::NotifyError($e->getMessage());

			$res = array('status'=>'error','msg' => json_decode($e->getMessage()));

		}

		return Response::json($res);

	}


	protected function storeTarefa(){

		try{

			$r = new Tarefa;

			$r->aluguel_id = $this->aluguel->id;
			$r->tipo_tarefa = Input::get('tipo_tarefa','place');
			$r->ordem = Input::get('ordem',null);
			$r->prioridade = Input::get('prioridade',null);
			$r->dt_tarefa = Input::get('dt_tarefa',$this->aluguel->dthr_inicio);
			$r->observacao = Input::get('observacao', null);
			$r->caminhao_id = Input::get('caminhao_id', null);
			$r->operador_id = Input::get('operador_id', null);
			$r->motorista_id = Input::get('motorista_id', null);
			$r->equipamentobase_id = Input::get('equipamentobase_id', null);
			$r->equipamento_id = Input::get('equipamento_id', null);
			$r->equipamento_novo_id = Input::get('equipamento_novo_id',null);
			$r->status = Input::get('status',1);
			$r->sessao_id = $this->id_sessao;

			$r->save();

			$res = $this->tarefa = $r;


		}catch(Exception $e){

			SysAdminHelper::NotifyError($e->getMessage());

			$res = array('status'=>'error','msg' => json_decode($e->getMessage()));

		}

		return $res;

	}

	protected function storeAluguel(){

		try{

			$equipamento_id = Input::get('equipamento_id', null);
			$valor_base = Input::get('valor_base', null);
			$valor_final = Input::get('valor_final', null);
			$status = Input::get('status', 1);
			$prioridade = Input::get('prioridade', null);
			$ordem = Input::get('ordem', null);
			$ajuste = Input::get('ajuste', null);

			$r = new Aluguel;

			$r->equipamento_id = $equipamento_id;
			$r->valor_base = $valor_base;
			$r->valor_final = $valor_final;
			$r->status = $status;
			$r->prioridade = $prioridade;
			$r->ordem = $ordem;
			$r->ajuste = $ajuste;
			$r->dthr_inicio = Input::get('dthr_inicio',null);
			$r->dthr_fim = Input::get('dthr_fim',null);

			$r->save();

			$res = $this->aluguel = $r;


		}catch(Exception $e){

			SysAdminHelper::NotifyError($e->getMessage());

			$res = array('status'=>'error','msg' => json_decode($e->getMessage()));

		}

		return $res;

	}

	public function getTarefasByEmpresaAndTipoTarefa($empresa_id,$tipo_tarefa){

		try{

			$e = Empresa::where('id','=',$empresa_id)->firstOrFail();

			$res = $e->Tarefas()->where('tipo_tarefa','=',$tipo_tarefa)->get();

		}catch(Exception $e){

			SysAdminHelper::NotifyError($e->getMessage());

			$res = array('status'=>'error','msg' => json_decode($e->getMessage()));

		}

		return Response::json($res);

	}


	public function getContratoByCliente($empresa_id,$cliente_id){

		try{

			$c = Cliente::where('id','=',$cliente_id)->firstOrFail();

			$cliente_id = $c->id;

			// Address
			$address = $c->Enderecocliente()->where('tipo','=','cobranca')->firstOrFail();
			$enderecocobranca_id = $address->id;


			$e = Empresa::where('id','=',$empresa_id)->firstOrFail();
			$empresa_id = $e->id;

			$r = Contrato::firstOrCreate(
			                             array(
			                                   'empresa_id' => $empresa_id,
			                                   'cliente_id' => $cliente_id,
			                                   'status'=> 1
			                                   )
			                             );

			$r->enderecocobranca_id = $enderecocobranca_id;
			$r->sessao_id = $this->id_sessao;
			$r->tipo_pagamento = $c->tipo_pagamento;
			$r->forma_pagamento = $c->forma_pagamento;
			$r->save();
			$r->dthr_cadastro = $r->created_at;
			$r->save();

			$this->contrato_id = $r->id;

			$res = $r;

		}catch(Exception $e){

			SysAdminHelper::NotifyError($e->getMessage());

			$res = array('status'=>'error','msg' => json_decode($e->getMessage()));

		}

		return Response::json($res);
	}


	public function disable(){

		try{

			$res = $this->changeStatus(Input::get('aluguel_id'),4);

		}catch(Exception $e){

			SysAdminHelper::NotifyError($e->getMessage());

			$res = array('status'=>'error','msg' => json_decode($e->getMessage()));

		}

		return $res;
	}


	protected function setStatus($locacao_id,$status){

		try{

			$r = Aluguel::where('id','=',$locacao_id)->firstOrFail();

			$r->status = $status;

			$r->save();

			$res = $r;

		}catch(Exception $e){

			SysAdminHelper::NotifyError($e->getMessage());

			$res = array('status'=>'error','msg' => json_decode($e->getMessage()));

		}

		return $res;

	}


	public function setMotoristaID(){
		try{

			$locacao = Aluguel::where('id','=',Input::get('aluguel_id'))->firstOrFail();

			$tarefa = $locacao->Tarefas()->where('tarefa_id','=',Input::get('tarefa_id'))->firstOrFail();
			$tarefa->motorista_id = Input::get('motorista_id');
			$tarefa->save();

			$res = $tarefa;


		}catch(Exception $e){

			SysAdminHelper::NotifyError($e->getMessage());

			$res = array('status'=>'error','msg' => json_decode($e->getMessage()));

		}

		return $res;
	}

	public function getAvailableCacambasByCompany($empresa_id){

		try{

			$r = Equipamento::where('empresa_id', '=', $empresa_id)->where('status','=',Input::get('status'));
			$res = $r->get();

		}catch(Exception $e){

			SysAdminHelper::NotifyError($e->getMessage());

			$res = array('status'=>'error','msg' => json_decode($e->getMessage()));

		}

		return Response::json($res);
	}

	/*
	public function getLocacoesByCompany($empresa_id){
		try{

			// cache for one day - 1440 minutes
			$res = Aluguel::where('empresa_id', '=', $empresa_id)->where('status','=',1)->remember(1440)->get();

		}catch(Exception $e){

			SysAdminHelper::NotifyError($e->getMessage());

			$res = array('status'=>'error','msg' => json_decode($e->getMessage()));
		}

		return Response::json($res);
	}
	*/


	public function getAvailableMotoristasByCompany($empresa_id){

		try{

			$res = Funcionario::where('empresa_id', '=', $empresa_id)->where('status','=',1)->get();


		}catch(Exception $e){

			SysAdminHelper::NotifyError($e->getMessage());

			$res = array('status'=>'error','msg' => json_decode($e->getMessage()));

		}

		return Response::json($res);
	}

}