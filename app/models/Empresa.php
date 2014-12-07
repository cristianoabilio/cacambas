<?php

class Empresa extends Eloquent {

	protected $table = 'empresa';

	//Override default PK 'id' from Eloquent
	//protected $primaryKey = 'id';

	protected $guarded = array();
	public static $rules = array();

	public function Enderecoempresa() {
			return $this->hasMany('Enderecoempresa');
	}

	public function caminhao () {
		return $this->hasMany('Caminhao');
	}

	public function cliente () {
		return $this->hasMany('Cliente');
	}

	public function Convenio() {
		return $this->hasMany('Convenio');
	}

	public function Contrato() {
		return $this->hasMany('Contrato');
	}

	public function custo () {
		return $this->hasManyThrough('Custo', 'Custogrouper');
	}

	public function Loginperfil() {
		return $this->hasMany('Loginperfil');
	}

	public function login () {
		return $this->hasMany('Login');
	}

	public function equipamento () {
		return $this->belongsToMany('Equipamento');
	}

	public function equipamentodetail () {
		return $this->hasManyThrough('Equipamentodetail','EmpresaEquipamento');
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

	public function resumoatividade() {
		return $this->hasMany('Resumoatividade');
	}

	public function Contabancaria() {
		return $this->hasMany('Contabancaria');
	}

	public function Funcionario() {
		return $this->hasMany('Funcionario');
	}

	public function Tarefas() {
		return $this->hasMany('Tarefa', 'IDTarefa', 'IDTarefa');
	}

	/*Scopes*/
	//equipamentodetails
	public function scopeEquipamentodetail ($query) {
		return $query	->where('')
		;
	}
	
}
