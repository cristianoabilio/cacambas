<?php

class Proposta extends Eloquent {

	protected $table = 'proposta';

	//Override default PK 'id' from Eloquent  
	protected $primaryKey = 'id';

	protected $guarded = array();
	public static $rules = array();

	public function Precontrato() { 
		return $this->belongsTo('Precontrato');
	}

}
