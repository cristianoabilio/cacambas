<?php

class Compras extends Eloquent {

	protected $table = 'compras';

	//Override default PK 'id' from Eloquent  
	protected $primaryKey = 'id';

	protected $guarded = array();
	public static $rules = array();

	public function Convenio() { 
		return $this->belongsTo('Convenio');
	}

	public function Produto() { 
		return $this->belongsTo('Produto');
	}



}
