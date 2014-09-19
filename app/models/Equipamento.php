<?php

class Equipamento extends Eloquent {
	protected $table = 'equipamento';
	
	//Override default PK 'id' from Eloquent  
	protected $primaryKey = 'id';

	protected $guarded = array();
	public static $rules = array();


	public function Custo() { 
			return $this->hasMany('Custo');
	}

	public function Equipamentobasepreco() { 
		return $this->belongsTo('Equipamentobasepreco',);
	}

	public function Operador() { 
		return $this->hasMany('Operador');
	}

}
