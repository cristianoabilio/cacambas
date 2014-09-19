<?php

class Loginperfil extends Eloquent {

	protected $table = 'loginperfil';


	//Override default PK 'id' from Eloquent  
	protected $primaryKey = 'id';

	protected $guarded = array();
	public static $rules = array();


	public function Login() { 
		return $this->belongsTo('Login');
	}

	public function Perfil() { 
		return $this->belongsTo('Perfil');
	}

}
