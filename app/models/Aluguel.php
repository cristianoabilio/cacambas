<?php

class Aluguel extends Eloquent {

	protected $table = 'aluguel';

	//Override default PK 'id' from Eloquent
	protected $primaryKey = 'id';

	protected $guarded = array();
	public static $rules = array();

	public function Contrato() {
			return $this->belongsTo('Contrato');
	}


	public function Tarefas(){
		return $this->hasMany('Tarefa');
	}


}
