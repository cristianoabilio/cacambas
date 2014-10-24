<?php 

class Produtocompra extends Eloquent {

	public function produto () {
		return $this->belongsTo('Produto');
	}

	public function produtofatura () {
		return $this->belongsTo('Produtofatura');
	}

	protected $fillable = array();

	/*
	* Produtocompra scopes
	*/

	/**
	* ------------------------------------------------------------
	* ScopeOnfatura 
	* ------------------------------------------------------------
	* Returns the produtocompra item related to a specific
	* invoice (produtofatura) and a specific tangible product.
	* 
	* Required for searching a specific product inside any given
	* invoice (produtofatura).
	* 
	* @param 	$fatura_id: the produtofatura id
	* @param 	$produto_id: the produto id
	*
	* @return 	unparsed query.  Data must be parsed with 
	*			->first() or ->count() Eloquent methods
	* 
	*/
	public function scopeOnfatura ($query,$fatura_id,$produto_id) {
		return $query->whereProdutofatura_id($fatura_id)
		->whereProduto_id($produto_id);
	}

}