<?php

class Plano extends Eloquent {

	protected $table = 'plano';

	protected $guarded = array();
	public static $rules = array();

	public function Limite() { 
			return $this->hasOne('Limite');
	}

	public function Convenio() { 
		return $this->hasMany('Convenio');
	}

}
