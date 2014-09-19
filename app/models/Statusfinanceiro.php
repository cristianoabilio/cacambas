<?php

class Statusfinanceiro extends Eloquent {

	protected $table = 'statusfinanceiro';

	//Override default PK 'id' from Eloquent  
	protected $primaryKey = 'id';

	protected $guarded = array();
	public static $rules = array();
}
