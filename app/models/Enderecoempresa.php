<?php

class Enderecoempresa extends Eloquent {
	protected $table = 'enderecoempresa';

	//Override default PK 'id' from Eloquent  
	protected $primaryKey = 'id';

	protected $guarded = array();
	public static $rules = array();

	public function Endereco() { 
			return $this->belongsTo('Endereco');
	}

	public function Empresa() { 
		return $this->belongsTo('Empresa');
	}

}
