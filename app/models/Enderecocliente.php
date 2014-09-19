<?php

class Enderecocliente extends Eloquent {
	protected $table = 'enderecocliente';

	//Override default PK 'id' from Eloquent
	protected $primaryKey = 'id';

	protected $guarded = array();
	public static $rules = array();


	public function Endereco() {
			return $this->belongsTo('Endereco');
	}

	public function EnderecoBase() {
			return $this->belongsTo('Enderecobase');
	}

	public function Cliente() {
		return $this->belongsTo('Cliente');
	}


}
