<?php

class Endereco extends Eloquent {
	protected $table = 'endereco';

	//Override default PK 'id' from Eloquent  
	protected $primaryKey = 'id';

	protected $guarded = array();
	public static $rules = array();

	public function Enderecobase() { 
			return $this->belongsTo('Enderecobase');
	}

	public function Enderecocliente() { 
		return $this->hasMany('Enderecocliente');
	}

	public function Enderecoempresa() { 
		return $this->hasMany('Enderecoempresa');
	}

}
