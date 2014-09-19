<?php

class Empresa extends Eloquent {

	protected $table = 'empresa';

	//Override default PK 'id' from Eloquent
	protected $primaryKey = 'id';

	protected $guarded = array();
	public static $rules = array();

	public function Enderecoempresa() {
			return $this->hasMany('Enderecoempresa');
	}

	public function Convenio() {
		return $this->hasMany('Convenio');
	}

	public function Contrato() {
		return $this->hasMany('Contrato');
	}

	public function Loginperfil() {
		return $this->hasMany('Loginperfil');
	}

	public function Empresaclienteanotacoes() {
		return $this->hasMany('Empresaclienteanotacoes');
	}

	public function Mensagem() {
		return $this->hasMany('Mensagem');
	}

	public function Resumofinanceiro() {
		return $this->hasMany('Resumofinanceiro');
	}

	public function Resumoempresacliente() {
		return $this->hasMany('Resumoempresacliente');
	}

	public function Contabancaria() {
		return $this->hasMany('Contabancaria');
	}

	public function Equipamentobasepreco() {
		return $this->hasMany('Equipamentobasepreco');
	}

	public function Funcionario() {
		return $this->hasMany('Funcionario');
	}

	public function Tarefas() {
		return $this->hasMany('Tarefa', 'IDTarefa', 'IDTarefa');
	}
}
