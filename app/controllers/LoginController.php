<?php

class LoginController extends BaseController {

	//protected $layout = 'templates.login';

    //public function __construct() {
      // $this->beforeFilter('csrf-check', array('on'=>'post'));
    //}

    /*======================================
    =            Auth Functions            =
    ======================================*/

	public function doLogin(){
		try{

			$usuario = Input::get('usuario',null);
			$senha   = Input::get('senha',null);
			$rememberLogin = Input::get('rememberLogin',false);

			$validator = Validator::make(
				array(
					'usuario'  => $usuario,
					'senha'    => $senha
					),
				array(
					'usuario'  => 'required',
					'senha'    => 'required'
					),
				array(
					'required' => 'required',
					)
				)
			;

			// If validation fails, return the messages in 'validator object'
			if ($validator->fails()) {
				return Response::json(
					[
					'success'   => false,
					'message'   => 'auth-validator-fail',
					'data'      => array('validator' => $validator->messages())
					],
					401
					)
				;
			}
			$trylogin=array(
				'login' => $usuario,
				'password' => $senha,
				'status' => 1
				)
			;

			if (Auth::attempt( $trylogin, $rememberLogin)){

			$sessao = Sessao::firstOrNew(array('laravel_session_id'=>Session::getId()));
			$sessao->login_id = Auth::user()->id;
			$sessao->dthr_login = date('Y-m-d H:i:s');
			$sessao->dthr_logoff = '0000-00-00 00:00:00';
			$sessao->ip = Request::getClientIp();
			$sessao->save();

			$login = Login::findOrFail(Auth::id());
			$login->remember_token = $rememberLogin;
			$login->save();

			// Return the response in json, with the user data and current session
			return Response::json([
				'success'  => true,
				'message' => 'auth-login-success',
				'data'    => array(
					'usuario' => Auth::user(),
					'sessao'  => Session::all(),
					'perfis' => Login::find( Auth::id() )->Perfil
					//()->wherePivot('status', 1)->get() //IF need by status
					)
				]
				)
			;
		}
		else {

			// Check if fails was because the user has blocked
			if(Login::where('login', $usuario)->first()->status == 0) {
				return Response::json([
					'success'  => false,
					'message' => 'auth-login-error',
					'data'    => null
					],
					401)
				;
			}
			else // Else, not authorized
			{
				return Response::json([
					'success'  => false,
					'message' => 'auth-not-authorized',
					'data'    => null
					],
					401
					)
				;
			}
		}

}
catch(Exception $e){
            // Excepetion on Login
	return Response::json([
		'success'  => false,
		'message' => 'auth-login-exception',
		'data'    => array(
			'error' => $e->getMessage()
			)
		], 400);
}

}

public function logout(){
	try{

		$sessao = Sessao::where('laravel_session_id','=',Session::getId())->first();
		if($sessao){
			$sessao->dthr_logoff = date('Y-m-d H:i:s');
			$sessao->save();
		}

		Auth::logout();

		$res = [ 'success'  => true,
		'message' => 'auth-logout-success',
		'data'    => null
		];
		$code = 200;

	}
	catch(Exception $e){

		SysAdminHelper::NotifyError($e->getMessage());

		$res = [ 'success'  => false,
		'message' => 'auth-logout-error',
		'data'    => array(
			'error' => $e->getMessage()
			)
		];
		$code = 503;
	}
	return Response::json($res, $code);
}



public function getSession(){
	try{
		$res = [ 'success'  => true,
		'message' => 'auth-session-success',
		'data'    => Session::all()
		];
		$code = 200;

	}
	catch(Exception $e){

		SysAdminHelper::NotifyError($e->getMessage());

		$res = [ 'success'  => false,
		'message' => 'auth-session-error',
		'data'    => array(
			'error' => $e->getMessage()
			)
		];
		$code = 503;
	}
	return Response::json($res, $code);
}

/*-----  End of Auth Functions  ------*/



    /*============================
    =            CRUD            =
    ============================*/
    public $header=array(
        array('empresa_id',1),
        array('login',1),
        array('nome',1),
        array('email',1)
        )
    ;

    public function index() {
    	return Login::all();
    }

    public function visible() {
        $header=$this->header;
        $login=Login::all();
        return View::make(
            'tempviews.login.index'
            ,compact(
                'header',
                'login'
                )
            );
    }

    public function logged(){
    	if(Auth::check())
            // Return the response in json, with the user data and current session
    		return Response::json([
    			'success'  => true,
    			'message' => 'auth-login-success',
    			'data'    => array(
    				'usuario' => Auth::user(),
    				'sessao'  => Session::all(), 
    				'perfis'  => Login::find( Auth::id() )->Perfil
    				)
    			]);
    	else
            // Not Authorized
    		return Response::json([
    			'success'  => false,
    			'message' => 'auth-not-authorized',
    			'data'    => null
    			], 401);
    }


    public function store()
    {

    	try{

    		$login = Input::get('login',null);
    		$senha = Input::get('senha',null);
    		$status = Input::get('status',null);

    		$empresa_id = Input::get('empresa_id',null);
    		$perfil_id = Input::get('perfil_id', null);

    		$validator = Validator::make(
    			array(
    				Input::All()
    				),
    			array(
    				'login' => 'required',
    				'senha' => 'required',
    				'status' => 'required',
    				'empresa_id' => 'required',
    				'perfil_id' => 'required'
    				),
    			array(
    				'required' => 'Preencha o campo :attribute.',
    				)
    			)
            ;

            //check if username is already on use
            if (Login::whereLogin($login)->count()>0) {
                $mssg='login name already on use';
                throw new Exception(
                     ('login name already on use')
                    )
                ;
            }

            //check if email is already on use
            /*if (Login::whereEmail($success['email'])->count()>0) {
                $datamssg='';
                throw new Exception(
                     ('Email already on use, choose a different one')
                    )
                ;
            }*/

    		if ($validator->fails()) {
                $mssg=array('validation_errors'=>$validator->messages()->all());
                throw new Exception(
                    json_encode(
                        array(
                            'validation_errors'=>$validator->messages()->all())
                        )
                    )
                ;
            }
    			

    		$r = new Login;
    		$r->login = $login;
    		$r->senha = $senha;
    		$r->dthr_ultimoacesso = date('Y-m-d H:i:s');
    		$r->dthr_cadastro = date('Y-m-d H:i:s');
    		$r->status = $status;

    		$r->save();


            //profile
    		$p = new Loginperfil;
    		$p->login_id = $r->id;
    		$p->empresa_id = $empresa_id;
    		$p->perfil_id = $perfil_id;
    		$p->dthr_cadastro = $r->dthr_cadastro;
    		$p->save();


    		$res = array('status'=>'success','msg' => 'Registro salvo com sucesso!');

    	}catch(Exception $e){

    		SysAdminHelper::NotifyError($e->getMessage());

    		$res = array(
                'status'=>'error',
                'msg' => $mssg//json_decode($e->getMessage())
                )
            ;

    	}


    	return Response::json($res);

    }

    public function show ($id) {
        return Login::find($id);
    }

    public function showvisible($id) {
        $header=$this->header;
        $login=Login::find($id);
        return View::make(
            'tempviews.login.show',
            compact(
                'id',
                'header',
                'login'
                )
            )
        ;
    }


    public function update()
    {
    	try{

    		$login = Input::get('login',null);
    		$senha = Input::get('senha',null);
    		$status = Input::get('status',null);
    		$id = Input::get('id',null);

    		$empresa_id = Input::get('empresa_id',null);
    		$perfil_id = Input::get('perfil_id', null);

    		$validator = Validator::make(
    			array(
    				Input::All()
    				),
    			array(
    				'login' => 'required',
    				'senha' => 'required',
    				'status' => 'required',
    				'id' => 'required',
    				'empresa_id' => 'required',
    				'perfil_id' => 'required'
    				),
    			array(
    				'required' => 'Preencha o campo :attribute.',
    				)
    			);

    		if ($validator->fails())
    			throw new Exception(json_encode(array('validation_errors'=>$validator->messages()->all())));

    		$r = Login::findOrFail($id);
    		$r->login = $login;
    		$r->senha = $senha;
    		$r->dthr_ultimoacesso = date('Y-m-d H:i:s');
    		$r->status = $status;
    		$r->save();


    		$p = Loginperfil::findOrFail($r->login_id);
    		$p->empresa_id = $empresa_id;
    		$p->perfil_id = $perfil_id;
    		$p->save();

    		$res = array('status'=>'success','msg' => 'Registro atualizado com sucesso!');

    	}catch(Exception $e){

    		SysAdminHelper::NotifyError($e->getMessage());

    		$res = array('status'=>'error','msg' => json_decode($e->getMessage()));

    	}

    	return Response::json($res);
    }


    public function destroy()
    {
    	try{

    		$id = Input::get('id',null);

    		$validator = Validator::make(
    			array(

    				'id' => $id
    				),
    			array(
    				'id' => 'required'
    				),
    			array(
    				'required' => 'Preencha o campo :attribute.',
    				)
    			);

    		if ($validator->fails())
    			throw new Exception(json_encode(array('validation_errors'=>$validator->messages()->all())));

    		$r = Login::findOrFail($id);
    		$r->delete();

    		$res = array('status'=>'success','msg' => 'Registro excluído com sucesso!');

    	}catch(Exception $e){

    		SysAdminHelper::NotifyError($e->getMessage());

    		$res = array('status'=>'error','msg' => json_decode($e->getMessage()));

    	}

    	return Response::json($res);
    }

    /*-----  End of CRUD  ------*/


}