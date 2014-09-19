<?php

class Classe extends Eloquent {

	protected $table = 'classe';

	//Override default PK 'id' from Eloquent  
	protected $primaryKey = 'id';

	protected $guarded = array();
	public static $rules = array();

	public function Subclasse() { 
			return $this->hasMany('Subclasse');
	}
}
