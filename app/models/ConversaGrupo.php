<?php

class ConversaGrupo extends \Eloquent {
	protected $table = 'conversa_grupo';


	//Override default PK 'id' from Eloquent  
	protected $primaryKey = 'id';

	protected $guarded = array();
	public static $rules = array();	
}