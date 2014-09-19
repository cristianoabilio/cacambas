<?php

class Contrato extends Eloquent {

	protected $table = 'contrato';

	//Override default PK 'id' from Eloquent  
	protected $primaryKey = 'id';

	protected $guarded = array();
	public static $rules = array();
	
	public function Recebimento() { 
		return $this->hasOne('Recebimento');
	}

	public function Aluguel() { 
		return $this->hasMany('Aluguel');
	}

	public function Tarefa() { 
		return $this->hasMany('Tarefa');
	}

	public function Cliente() { 
		return $this->belongsTo('Cliente');
	}

	public function Empresa() {
	 return $this->belongsTo('Empresa');
	}
}
