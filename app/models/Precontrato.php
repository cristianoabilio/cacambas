<?php

class Precontrato extends Eloquent {

	protected $table = 'precontrato';

	//Override default PK 'id' from Eloquent  
	protected $primaryKey = 'id';

	protected $guarded = array();
	public static $rules = array();

	public function Proposta() { 
			return $this->hasMany('Proposta');
	}

	public function Prealuguel() { 
		return $this->hasMany('Prealuguel');
	}

	public function Cliente() { 
		return $this->belongsTo('Cliente');
	}
}
