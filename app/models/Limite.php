<?php

class Limite extends Eloquent {

	protected $table = 'limite';

	protected $guarded = array();
	public static $rules = array();

	public function Plano() { 
			return $this->belongsTo('Plano');
	}

	public function Convenio() { 
		return $this->hasMany('Convenio');
	}

}