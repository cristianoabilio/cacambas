<?php

class Limite extends Eloquent {

	protected $table = 'limite';

	//Override default PK 'id' from Eloquent  
	protected $primaryKey = 'id';

	protected $guarded = array();
	public static $rules = array();

	public function Plano() { 
			return $this->belongsTo('Plano');
	}

	public function Convenio() { 
		return $this->belongsTo('Convenio');
	}

}