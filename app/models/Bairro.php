<?php

class Bairro extends Eloquent {

	protected $table = 'bairro';

	//Override default PK 'id' from Eloquent
	protected $primaryKey = 'id';

	protected $guarded = array();
	public static $rules = array();


	public function Cidade() {
		 return $this->belongsTo('Cidade');
	}


	public function Enderecobase() {
		return $this->hasMany('Enderecobase');
	}
}
