<?php 

class Produtocompra extends Eloquent {

	public function produto () {
		return $this->belongsTo('Produto');
	}

	public function produtofatura () {
		return $this->belongsTo('Produtofatura');
	}

	protected $fillable = array();

}