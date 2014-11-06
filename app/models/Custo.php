<?php

class Custo extends Eloquent {
	protected $table = 'custo';

	protected $guarded = array();
	public static $rules = array();

	public function Subclasse() { 
			return $this->belongsTo('Subclasse');
	}

	public function Funcionario() { 
			return $this->belongsTo('Funcionario');
	}

	public function Caminhao() { 
			return $this->belongsTo('Caminhao');
	}

	public function Equipamento() { 
		return $this->belongsTo('Equipamento');
	}

}
