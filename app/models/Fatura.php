<?php

class Fatura extends Eloquent {

	protected $table = 'fatura';

	//Override default PK 'id' from Eloquent  
	protected $primaryKey = 'id';

	protected $guarded = array();
	public static $rules = array();


	public function Convenio() { 
		return $this->belongsTo('Convenio');
	}
}
