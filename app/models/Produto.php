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



	/**
	* --------------------------------------------------
	* PRODUTO SCOPES
	* --------------------------------------------------
	*/

	//scoping produto as servico
	public function scopeServico ($query) {
		return $query->whereServico(1)
		->whereStatus(1)
		;
	}

	//scoping produto as tangible produto
	public function scopeIsproduto ($query) {
		return $query->whereServico(0)
		->whereStatus(1)
		;
	}
}
