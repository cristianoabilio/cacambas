<?php

class Empresaclienteanotacoes extends Eloquent {
	protected $table = 'empresaclienteanotacoes';


	public function Cliente() { 
			return $this->belongsTo('Cliente');
	}

	public function Empresa() { 
		return $this->belongsTo('Empresa');
	}


	protected $guarded = array();

	public static $rules = array();
}
