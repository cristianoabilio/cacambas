<?php

class Custo extends Eloquent {

	protected $guarded = array();
	public static $rules = array();

	public function custogrouper () {
		return $this->belongsTo('Custogrouper');
	}

	public function custodetail () {
		return $this->belongsTo('Custodetail');
	}
	
	public function scopeActive ($query) {
		return $query	->whereStatus_custo(1);
		;
	}

	public function scopeNoactive ($query) {
		return $query	->whereStatus_custo(0);
		;
	}
	

}
