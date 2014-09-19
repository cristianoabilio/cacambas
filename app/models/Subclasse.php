<?php

class Subclasse extends Eloquent {

	protected $table = 'subclasse';
	
	//Override default PK 'id' from Eloquent  
	protected $primaryKey = 'id';

	protected $guarded = array();
	public static $rules = array();

	public function Classe() { 
		return $this->belongsTo('Classe');
	}
	public function Custo() { 
		return $this->hasMany('Custo');
	}
}
