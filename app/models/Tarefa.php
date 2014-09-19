<?php

class Tarefa extends Eloquent {

	protected $table = 'tarefa';
	
	//Override default PK 'id' from Eloquent  
	protected $primaryKey = 'id';

	protected $guarded = array();
	public static $rules = array();


	public function Contrato() { 
			return $this->belongsTo('Contrato');
	}

	public function Aluguel() { 
			return $this->belongsTo('Aluguel');
	}
}
