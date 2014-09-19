<?php

class Equipamentobasepreco extends Eloquent {

	protected $table = 'equipamentobasepreco';

	//Override default PK 'id' from Eloquent  
	protected $primaryKey = 'id';

	protected $guarded = array();
	public static $rules = array();

	
	public function Taxa() { 
			return $this->hasMany('Taxa');
	}

	public function Equipamento() { 
		return $this->hasMany('Equipamento');
	}

	public function Equipamentobase() { 
		return $this->belongsTo('Equipamentobase');
	}

	public function Empresa() { 
		return $this->belongsTo('Empresa');
	}

}
