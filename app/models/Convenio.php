<?php

class Convenio extends Eloquent {
	protected $table = 'convenio';

	//Override default PK 'id' from Eloquent  
	protected $primaryKey = 'id';

	protected $guarded = array();
	public static $rules = array();
	
	public function Fatura() { 
			return $this->hasMany('Fatura');
	}

	public function produtofatura () {
		return $this->hasMany('Produtofatura');
	}

	public function Limite() { 
			return $this->belongsTo('Limite');
	}

	public function Plano() { 
			return $this->belongsTo('Plano');
	}

	public function Compras() { 
			return $this->hasMany('Compras');
	}

	public function Empresa() { 
		return $this->belongsTo('Empresa');
	}


}
