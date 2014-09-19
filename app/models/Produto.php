<?php

class Produto extends Eloquent {

	protected $table = 'produto';

	//Override default PK 'id' from Eloquent  
	protected $primaryKey = 'id';

	protected $guarded = array();
	public static $rules = array();

	public function Compras() { 
			return $this->hasMany('Compras');
	}
}
