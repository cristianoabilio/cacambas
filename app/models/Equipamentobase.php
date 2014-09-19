<?php

class Equipamentobase extends Eloquent {
	
	protected $table = 'equipamentobase';

	//Override default PK 'id' from Eloquent  
	protected $primaryKey = 'id';

	protected $guarded = array();
	public static $rules = array();


	public function Equipamentobasepreco() { 
			return $this->hasMany('Equipamentobasepreco');
	}

}
