<?php

class Cliente extends Eloquent {

	protected $table = 'cliente';

	//Override default PK 'id' from Eloquent
	protected $primaryKey = 'id';

	protected $guarded = array();
	public static $rules = array();

	public function Enderecocliente() {
		return $this->hasMany('Enderecocliente');
	}

	public function Precontrato() {
		return $this->hasMany('Precontrato');
	}

	public function Contrato() {
		return $this->hasMany('Contrato');
	}

	public function Contato() {
		return $this->hasMany('Contato');
	}

	public function Mensagemcliente() {
		return $this->hasMany('Mensagemcliente');
	}

	public function Empresaclienteanotacoes() {
		return $this->hasMany('Empresaclienteanotacoes');
	}

	public function Login() {
        return $this->hasOne('Login');
    }

    public function anotacoe () {
    	return $this->hasMany('Anotacoe');
    }

}
