<?php

class Notification extends \Eloquent {
	protected $table = 'notification';


	//Override default PK 'id' from Eloquent  
	protected $primaryKey = 'id';

	protected $guarded = array();
	public static $rules = array();
}