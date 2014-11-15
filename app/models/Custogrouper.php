<?php

class Custogrouper extends \Eloquent {
	protected $fillable = [];

	public function empresa () {
		return $this->belongsTo('empresa');
	}

	public function custo () {
		return $this->hasMany('custo');
	}

}