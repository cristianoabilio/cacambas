<?php

class Taxa extends Eloquent {

	protected $table = 'taxa';
	
	//Override default PK 'id' from Eloquent  
	protected $primaryKey = 'id';

	protected $guarded = array();
	public static $rules = array();

	public function Equipamentobasepreco() {
	 	return $this->belongsTo('Equipamentobasepreco');
	 }	
}
