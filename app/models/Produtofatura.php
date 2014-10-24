<?php 

class Produtofatura extends Eloquent {

	public function convenio () {
		return $this->belongsTo('Convenio');
	}

	public function produtocompra () {
		return $this->hasMany('Produtocompra');
	}


	protected $fillable = array();

}