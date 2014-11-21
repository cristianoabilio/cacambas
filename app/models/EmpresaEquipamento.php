<?php

class EmpresaEquipamento extends \Eloquent {
	protected $table = 'empresa_equipamento';
	protected $fillable = [];

	public function equipamentodetail() {
		return $this->hasOne('Equipamentodetail');
	}

	public function equipamento () {
		return $this->belongsTo('Equipamento');
	}
}