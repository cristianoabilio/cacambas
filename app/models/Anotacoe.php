<?php

class Anotacoe extends \Eloquent {
	protected $fillable = [];
	public function login(){
		return $this->belongsTo('Login');
	}
}