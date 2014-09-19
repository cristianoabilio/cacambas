<?php

class Caminhaomotorista extends Eloquent {

	protected $table = 'caminhaomotorista';

	//Override default PK 'id' from Eloquent  
	protected $primaryKey = 'id';
	protected $guarded = array();
	public static $rules = array();

	public function Funcionario() { 
			return $this->belongsTo('Funcionario');
	}

	public function Caminhao() { 
		return $this->belongsTo('Caminhao');
	}

}
