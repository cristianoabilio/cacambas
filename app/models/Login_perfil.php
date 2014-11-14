<?php

class Login_perfil extends Eloquent {
	
	protected $guarded = array();
	public static $rules = array();


	public function Login() { 
		return $this->belongsTo('Login');
	}

	public function Perfil() { 
		return $this->belongsTo('Perfil');
	}

}
