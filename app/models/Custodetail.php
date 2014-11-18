<?php

class Custodetail extends \Eloquent {
	protected $fillable = [];
	public function subclasse () {
		return $this->belongsTo('Subclasse');
	}
}