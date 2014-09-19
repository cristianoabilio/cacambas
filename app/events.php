<?php

Event::listen('auth.login', function($user)
{

    $sessao = Sessao::firstOrNew(array('laravel_session_id'=>Session::getId()));
    $sessao->login_id = Auth::user()->id;
    $sessao->dthr_login = date('Y-m-d H:i:s');
    $sessao->dthr_logoff = '0000-00-00 00:00:00';
    $sessao->ip = Request::getClientIp();
    $sessao->save();

    Log::info('[LOGIN] Dados de sessao gravados.');

});


Event::listen('auth.logout', function($user)
{

    $sessao = Sessao::where('laravel_session_id','=',Session::getId())->first();
    if($sessao){
        $sessao->dthr_logoff = date('Y-m-d H:i:s');
        $sessao->save();
    }


    Log::info('[LOGOUT] Dados de sessao gravados.');

});