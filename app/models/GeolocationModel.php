<?php

class GeolocationModel extends \Eloquent {
	protected $fillable = [];
	
	protected $table = 'geolocation';

	//Override default PK 'id' from Eloquent  
	protected $primaryKey = 'id';

	protected $guarded = array();
	public static $rules = array();
	
}