<?php

class Plano extends Eloquent {

	protected $table = 'plano';

	//Override default PK 'id' from Eloquent  
	protected $primaryKey = 'id';

	protected $guarded = array();
	public static $rules = array();

	public function Limite() { 
			return $this->hasOne('Limite');
	}

	public function Convenio() { 
		return $this->hasMany('Convenio');
	}

}
