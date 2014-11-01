<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

/**
* 
* WARNING ABOUT FILTERS ON RESTFUL CONTROLLERS
* instead fo using "table_id" wildcards, syntax should
* be "table"
* @example estado/{estado}/cidade/{cidade}
* DO NOT USE {estado_id} or {cidade_id} as this is not
* the Laravel convention
* USING CONVENTIONS DIMINISHES THE PROBABILITY OF BUGS AND
* MAKES CODE CLEANER AND EASIER TO MAINTAIN!!!
*/


Route::filter('checkestadocidadebairro',function($route,$request){
	//Retrieving resource ids for estadocidadebairro restful URI
	$estado_id=$route->getParameter('estado');
	$checkcidade=Cidade::find($route->getParameter('cidade'));

	$response=null;
	$case=0;

	//1. Check if estado exists
	if (Estado::find($estado_id)==null) {
		$case=1;//Estado does not exist
	}

	//2. Check if cidade exists
	else if ($checkcidade==null) {
		$case=2;//Cidade does not exist
	}

	//3. Check if cidade belongs to estado
	else if($checkcidade->estado_id!=$estado_id){
		$case=3;//Cidade does not belongs to Estado
	}

	if ($case>0) {
		//switch options for case
		switch ($case) {
			case '1':$case='Estado no exist';
			break;
			case '2':$case='Cidade no exist';
			break;
			case '3':$case='Cidade does not belong to Estado';
			break;
		}

		$d=new StandardResponse;
		$mssg=$d->responsedata(
			'bairro',
			false,
			'resource',
			$case
			)
		;
		$response=Response::json($mssg,400);
	}

	if (!null==$route->getParameter('bairro')  )
	{
		$bairro_id=$route->getParameter('bairro');
		$cidade_id=$route->getParameter('cidade');
		//4. Check that bairro exists
		if (Bairro::find($bairro_id)==null) {
			$case=4;//Bairro does not exist
		} 
		//5. Check that bairro belongs to cidade
		else if (Bairro::find($bairro_id)->cidade_id==$cidade_id) {
			$case=5;//Bairro does not belong to cidade
		}
		if ($case>0) {
			//switch options for case
			switch ($case) {
				case '4':$case='Bairro no exist';
				break;
				case '5':$case='Bairro does not belong to Cidade';
				break;
			}

			$d=new StandardResponse;
			$mssg=$d->responsedata(
				'bairro',
				false,
				'resource',
				$case
				)
			;
			$response=Response::json($mssg,400);
		}
	}

	return $response;
});

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::guest('login');
		}
	}
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});
