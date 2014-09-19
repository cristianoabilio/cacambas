<?php

class RemindersController extends Controller {

	/**
	 * Display the password reminder view.
	 *
	 * @return Response
	 */
	//public function getRemind()
	//{
	//	return View::make('password.remind');
	//}

	/**
	 * Handle a POST request to remind a user of their password.
	 *
	 * @return Response
	 */
	public function postRemind()
	{
		switch ($response = Password::remind(Input::only('email'), function($message){ $message->subject('Redefinir sua Senha'); }))
		{
			case Password::INVALID_USER:
				return Response::json([
                                        'success'  => false,
                                        'message'  => 'remind-invalid-user',
                                        'data'     => array(
                                                        'error' => Lang::get($response)
                                                     )
                                        ], 403);
			case Password::REMINDER_SENT:
				return Response::json([
                                        'success'  => true,
                                        'message'  => 'remind-sent',
                                        'data'     =>  Lang::get($response)                  
                                        ]);
		}
	}

	/**
	 * Display the password reset view for the given token.
	 *
	 * @param  string  $token
	 * @return Response
	 */
	public function getReset($token = null)
	{
		if (is_null($token)) return Redirect::to('/#/404/reset');

		return Redirect::to('/#/reset/' . $token);
	}

	/**
	 * Handle a POST request to reset a user's password.
	 *
	 * @return Response
	 */
	public function postReset()
	{
		$credentials = array(
				'email' => Input::get('email'),
				'password' => Input::get('password'), 
				'password_confirmation' => Input::get('password_confirmation'), 
				'token' => Input::get('token')
			
		);

		$response = Password::reset($credentials, function($user, $password)
		{
			$user->senha = Hash::make($password);

			$user->save();
		});

		switch ($response)
		{
			case Password::INVALID_PASSWORD:
				return Response::json([
                                        'success'  => false,
                                        'message'  => 'reset-invalid-password',
                                        'data'     =>  Lang::get($response)                 
                                        ], 403);

			case Password::INVALID_TOKEN:
				return Response::json([
                                        'success'  => false,
                                        'message'  => 'reset-invalid-token',
                                        'data'     =>  Lang::get($response)                 
                                        ], 403);

			case Password::INVALID_USER:
				return Response::json([
                                        'success'  => false,
                                        'message'  => 'reset-invalid-user',
                                        'data'     =>  Lang::get($response)                 
                                        ], 403);

			case Password::PASSWORD_RESET:
				return Response::json([
                                        'success'  => true,
                                        'message'  => 'reset-password-success',
                                        'data'     =>  null                 
                                        ]);
		}
	}

}
