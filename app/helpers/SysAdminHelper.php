<?php

class SysAdminHelper{
    public static function NotifyError($error_message){

        try{

            Log::error('[CAÇAMBAS.COM] '.$error_message);

            Mail::send('emails.sys_error', array('error_message'=>$error_message), function($message){
                $message->from('sys@cacambas.com', 'Caçambas.com');
                $message->to(Config::get('cacambas.email_suporte_ti'), Config::get('cacambas.email_suporte_ti'))->subject('[CAÇAMBAS.COM] Erro de Sistema');
            });

        }catch(Exception $e){

            Log::error('[SysAdminHelper] '.$e->getMessage());

            return $e->getMessage();

        }
    }


}
