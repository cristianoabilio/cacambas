<?php

class Contato extends Eloquent {

	protected $table = 'contato';

	//Override default PK 'id' from Eloquent  
	protected $primaryKey = 'id';

	protected $guarded = array();
	public static $rules = array();

	public function Cliente() { 
			return $this->belongsTo('Cliente');
	}

}
