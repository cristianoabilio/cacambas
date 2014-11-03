<?php


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


Route::filter('geoendereco',function($route,$request){
	$response=null;
	$case=0;
	//Retrieving resource ids for estadocidadebairro restful URI
	$estado_id=$route->getParameter('estado');
	


	//1. Check if estado exists
	if (Estado::find($estado_id)==null) {
		$case=1;//Estado does not exist
	}

	//2. Check if cidade exists
	else if (!null==$route->getParameter('cidade')) {
		$cidade_id=$route->getParameter('cidade');
		$checkcidade=Cidade::find($cidade_id);
		if ($checkcidade==null) 
		{
			$case=2;//Cidade does not exist
		} 
		//3. Check if cidade belongs to estado
		else if ($checkcidade->estado_id!=$estado_id) {
			$case=3;//Cidade does not belongs to Estado
		}
		//4. Check if there is a bairro parameter
		else if(!null==$route->getParameter('bairro') ) {
			$bairro_id=$route->getParameter('bairro');
			$checkbairro=Bairro::find($bairro_id);

			//4.1. Check if bairro exists
			if ($checkbairro==null) {
				$case=4;//Bairro resource does not exist
			} 

			//4.2. Check if bairro belongs to cidade
			else if ($checkbairro->cidade_id!=$cidade_id) {
				$case=5;//Bairro do not belong to cidade
			}

			//5. Check if there is a enderecobase parameter
			else if (!null==$route->getParameter('enderecobase')){
				$enderecobase_id=$route->getParameter('enderecobase');
				$checkenderecobase=Enderecobase::find($enderecobase_id);

				//5.1 Check if enderecobase exists
				if ($checkenderecobase==null) {
					$case=6;//enderecobase does not exist
				}
				else if ($checkenderecobase->bairro_id!=$bairro_id) {
					$case=7;//enderecobase does not belong to bairro
				}

				//6. Check endereco parameter
				else if (!null==$route->getParameter('endereco')) {
					$endereco_id=$route->getParameter('endereco');
					$checkendereco=Endereco::find($endereco_id);

					//6.1 Check if endereco exists
					if ($checkendereco==null) {
						$case=8;//endereco does not exist
					}

					//6.2 Check if endereco belongs to enderecobase
					else if ($checkendereco->enderecobase_id!=$enderecobase_id) {
						$case=9;//endereco does not belong to enderecobase
					}
				}
			}
		}
	}

	if ($case>0) {
		//switch options for case
		switch ($case) {
			case '1':$case='Estado no exists';
			break;
			case '2':$case='Cidade no exists';
			break;
			case '3':$case='Cidade does not belong to Estado';
			break;
			case '4':$case='Bairro no exists';
			break;
			case '5':$case='Bairro does not belong to Cidade';
			break;
			case '6':$case='Enderecobase no exists';
			break;
			case '7':$case='Enderecobase does not belong to Bairro';
			break;
			case '8':$case='Endereco no exists';
			break;
			case '9':$case='Endereco does not belong to Enderecobase';
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
