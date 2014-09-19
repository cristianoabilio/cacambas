<?php

class Resumoatividade extends Eloquent {

	protected $table = 'resumoatividade';
	
	//Override default PK 'id' from Eloquent  
	protected $primaryKey = 'id';

	protected $guarded = array();
	public static $rules = array();

	public function Funcionario() { 
			return $this->belongsTo('Funcionario');
	}
}
