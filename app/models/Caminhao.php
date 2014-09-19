<?php

class Caminhao extends Eloquent {

	protected $table = 'caminhao';

	//Override default PK 'id' from Eloquent
	protected $primaryKey = 'id';
    
    protected $guarded = array();
    public static $rules = array();


	public function Funcionario() {
        return $this->belongsToMany('Funcionario', 'caminhaomotorista')->withPivot('status', 'dthr_inicio', 'dthr_fim');
    }

	public function Custo() { 
			return $this->hasMany('Custo');
	}



}
