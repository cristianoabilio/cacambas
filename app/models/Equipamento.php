<?php

class Equipamento extends \Eloquent {
	protected $fillable = [];

	public function empresa () {
		return $this->belongsToMany('Empresa');
	}

	/*
	pending to scope relationship with
	equipamentodetail
	*/
}