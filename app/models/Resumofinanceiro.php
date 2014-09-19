<?php

class Resumofinanceiro extends Eloquent {

	protected $table = 'resumofinanceiro';

	//Override default PK 'id' from Eloquent  
	protected $primaryKey = 'id';

	protected $guarded = array();
	public static $rules = array();


	public function Empresa() { 
			return $this->belongsTo('Empresa');
	}
}
