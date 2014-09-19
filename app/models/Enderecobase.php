<?php

class Enderecobase extends Eloquent {
	protected $table = 'enderecobase';

	//Override default PK 'id' from Eloquent
	protected $primaryKey = 'id';

	protected $guarded = array();
	public static $rules = array();

	public function Bairro() {
			return $this->belongsTo('Bairro');
	}

	public function Endereco() {
		return $this->hasMany('Endereco');
	}

	public function Estado(){
		return $this->belongsTo('Estado');
	}

	public function Cidade(){
		return $this->belongsTo('Cidade');
	}

}
