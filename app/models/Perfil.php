<?php

class Perfil extends Eloquent {

	protected $table = 'perfil';

	//Override default PK 'id' from Eloquent  
	protected $primaryKey = 'id';

	protected $guarded = array();
	public static $rules = array();


	public function Login(){
		return $this->belongsToMany('Login', 'loginperfil');
	}



}
