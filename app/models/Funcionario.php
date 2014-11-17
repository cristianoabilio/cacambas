<?php

class Funcionario extends Eloquent {

	protected $table = 'funcionario';

	//Override default PK 'id' from Eloquent  
	protected $primaryKey = 'id';

	protected $guarded = array();
	public static $rules = array();



	public function Empresa() {
		 return $this->belongsTo('Empresa');
	}

	public function Custo() { 
			return $this->hasMany('Custo');
	}

	public function Operador() { 
		return $this->hasMany('Operador');
	}

	public function Caminhao() {
        return $this->belongsToMany('Caminhao', 'caminhaomotorista')->withPivot('status', 'dthr_inicio', 'dthr_fim');
    }

	public function Resumoatividade() { 
		return $this->hasMany('Resumoatividade');
	}

	public function Login() {
        return $this->belongsTo('Login');
    }
}
