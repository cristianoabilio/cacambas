<?php

class Equipamentodetail extends \Eloquent {
	protected $fillable = [];

	public function empresa_equipamento () {
		return $this->belongsTo('EmpresaEquipamento');
	}

	public function equipamentoitem () {
		return $this->hasMany('Equipamentoitem');
	}

	public function taxa () {
		return $this->hasMany('taxa');
	}
}