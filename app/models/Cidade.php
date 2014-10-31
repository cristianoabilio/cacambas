<?php

class Cidade extends Eloquent {

	protected $table = 'cidade';

	//Override default PK 'id' from Eloquent
	//protected $primaryKey = 'id';

	protected $guarded = array();
	public static $rules = array();

	public function Estado() {
			return $this->belongsTo('Estado');
	}

  public function Enderecobase() {
    return $this->hasMany('Enderecobase');
  }

	public function Bairro() {
		return $this->hasMany('Bairro');
	}

}
