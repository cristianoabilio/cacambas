<?php

class Prealuguel extends Eloquent {

	protected $table = 'prealuguel';

	//Override default PK 'id' from Eloquent  
	protected $primaryKey = 'id';

	protected $guarded = array();
	public static $rules = array();

	public function Precontrato() { 
			return $this->belongsTo('Precontrato');
	}

}
