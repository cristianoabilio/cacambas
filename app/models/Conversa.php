<?php

class Conversa extends \Eloquent {
	protected $fillable = [];
	
	protected $table = 'conversa';

	//Override default PK 'id' from Eloquent  
	protected $primaryKey = 'id';

	protected $guarded = array();
	public static $rules = array();
	
}