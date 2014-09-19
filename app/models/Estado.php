<?php

class Estado extends Eloquent {

	protected $table = 'estado';

	//Override default PK 'id' from Eloquent
	protected $primaryKey = 'id';

	protected $guarded = array();
	public static $rules = array();

  public function Enderecobase() {
    return $this->hasMany('Enderecobase');
  }


	public function Cidade() {
			return $this->hasMany('Cidade');
	}
}
