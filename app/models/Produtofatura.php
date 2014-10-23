<?php 

class Produtofatura extends Eloquent {

	public function convenio () {
		return $this->belongsTo('Convenio');
	}


	protected $fillable = array();

}