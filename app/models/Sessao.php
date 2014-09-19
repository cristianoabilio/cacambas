<?php

class Sessao extends Eloquent {

	protected $table = 'sessao';
	protected $primaryKey = 'id';
    protected $guarded = array();
    public static $rules = array();

    public static function getId(){

        $session = Sessao::where('laravel_session_id','=',Session::getId())->first();

        if(is_null($session)){
            $session = new Sessao;
            $session->dthr_login = date('Y-m-d H:i:s');
            $session->laravel_session_id = Session::getId();
            $session->login_id = Auth::user()->id;
            $session->dthr_logoff = '0000-00-00 00:00:00';
        }

        $session->ip = Request::getClientIp();
        $session->save();

        return $session->id;

    }
}
