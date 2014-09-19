<?php

class Recebimento extends Eloquent {

	protected $table = 'recebimento';

	//Override default PK 'id' from Eloquent  
	protected $primaryKey = 'id';

	protected $guarded = array();
	public static $rules = array();


	public function Contrato() {
		return $this->belongsTo('Contrato');
	}

}
