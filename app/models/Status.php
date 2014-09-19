<?php

class Status extends Eloquent {

	protected $table = 'status';

	//Override default PK 'id' from Eloquent  
	protected $primaryKey = 'id';

	protected $guarded = array();
	public static $rules = array();

}
