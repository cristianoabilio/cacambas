<?php

class Equipamentoitem extends \Eloquent {
	protected $fillable = [];

	public function equipamentodetail() {
		return $this->belongsTo('Equipamentodetail');
	}

	public function operador () {
		return $this->hasMany('Operador');
	}

	/*
	public function custo () {
		return $this->hasMany('Custo');
	}
	DEPRECATED!!!

	***
	Relationship with custo should be retrieved
	with a scope function*/
}