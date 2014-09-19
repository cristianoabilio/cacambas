<?php

class Operador extends Eloquent {

	protected $table = 'operador';
	

	//Override default PK 'id' from Eloquent  
	protected $primaryKey = 'id';

	protected $guarded = array();
	public static $rules = array();



	public function Equipamento() { 
			return $this->belongsTo('Equipamento');
	}

	public function Funcionario() { 
		return $this->belongsTo('Funcionario');
	}

}
