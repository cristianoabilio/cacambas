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

Route::filter('empresa',function($route,$request){
	$response=null;
	$case=0;
	//Retrieving resource ids for empresa restful URI
	$empresa_id=$route->getParameter('empresa');

	$empresa=Empresa::whereId($empresa_id);

	if (Empresa::find($empresa_id)==null) {
		$case=1;//empresa does not exist
	} else {

		if (!null==$route->getParameter('enderecoempresa')) {
			$enderecoempresa_id=$route->getParameter('enderecoempresa');
			$enderecoempresa=Enderecoempresa::find($enderecoempresa_id);
			if ($enderecoempresa==null) {
				$case=2;//enderecoempresa does not exist
			} else if ($enderecoempresa->empresa_id!=$empresa_id) {
				$case=3;//enderecoempresa does not belong to current empresa resource
			}

		}
		if (!null==$route->getParameter('contabancaria')) {
			$contabancaria_id=$route->getParameter('contabancaria');
			$contabancaria=Contabancaria::find($contabancaria_id);
			if ($contabancaria==null) {
				$case=4;//contabancaria does not exist
			} else if ($contabancaria->empresa_id!=$empresa_id) {
				$case=5;//contabancaria does not belong to current empresa resource
			}

		}
		if (!null==$route->getParameter('convenio')) {
			$convenio_id=$route->getParameter('convenio');
			$convenio=Convenio::find($convenio_id);
			if ($convenio==null) {
				$case=6;//convenio does not exist
			} else if ($convenio->empresa_id!=$empresa_id) {
				$case=7;//convenio does not belong to current empresa resource
			}
			else if (!null==$route->getParameter('produtofatura')) {
				$produtofatura_id=$route->getParameter('produtofatura');
				$produtofatura=Produtofatura::find($produtofatura_id);
				if ($produtofatura==null) {
					$case=701;
				}
				else if ($produtofatura->convenio_id!=$convenio_id) {
					$case=702;
				}
			}
			else if (!null==$route->getParameter('fatura')) {
				$fatura_id=$route->getParameter('fatura');
				$fatura=Fatura::find($fatura_id);
				if ($fatura==null) {
					$case=703;
				}
				else if ($fatura->convenio_id!=$convenio_id) {
					$case=704;
				}
			}

		}
		if (!null==$route->getParameter('funcionario')) {
			$funcionario_id=$route->getParameter('funcionario');
			$funcionario=Funcionario::find($funcionario_id);
			if ($funcionario==null) {
				$case=8;//funcionario does not exist
			} else if ($funcionario->empresa_id!=$empresa_id) {
				$case=9;//funcionario does not belong to current empresa resource
			}
			else if (!null==$route->getParameter('resumoatividade')) {
				$resumoatividade_id=$route->getParameter('resumoatividade');
				$resumoatividade=Resumoatividade::find($resumoatividade_id);
				if ($resumoatividade==null) {
					$case=901;
				} else if ($resumoatividade->funcionario_id!=$funcionario_id) {
					$case=902;
				}
			}

		}
		if (!null==$route->getParameter('resumofinanceiro')) {
			$resumofinanceiro_id=$route->getParameter('resumofinanceiro');
			$resumofinanceiro=Resumofinanceiro::find($resumofinanceiro_id);
			if ($resumofinanceiro==null) {
				$case=10;//resumofinanceiro does not exist
			} else if ($resumofinanceiro->empresa_id!=$empresa_id) {
				$case=11;//resumofinanceiro does not belong to current empresa resource
			}

		}
		if (!null==$route->getParameter('resumoempresacliente')) {
			$resumoempresacliente_id=$route->getParameter('resumoempresacliente');
			$resumoempresacliente=Resumoempresacliente::find($resumoempresacliente_id);
			if ($resumoempresacliente==null) {
				$case=12;//resumoempresacliente does not exist
			} else if ($resumoempresacliente->empresa_id!=$empresa_id) {
				$case=13;//resumoempresacliente does not belong to current empresa resource
			}
		}

		if (!null==$route->getParameter('caminhao')) {
			$caminhao_id=$route->getParameter('caminhao');
			$caminhao=Caminhao::find($caminhao_id);
			if ($caminhao==null) {
				$case=14;//caminhao does not exist
			} else if ($caminhao->empresa_id!=$empresa_id) {
				$case=15;//caminhao does not belong to current empresa resource
			}
		}
	}

	if ($case>0) {
		switch ($case) {
			case '1':$case='Empresa does not exist';
				break;
			case '2':$case='Enderecoempresa does not exist';
				break;
			case '3':$case='Enderecoempresa does not belong to current empresa resource';
				break;
			case '4':$case='contabancaria does not exist';
				break;
			case '5':$case='contabancaria does not belong to current empresa resource';
				break;
			case '6':$case='convenio does not exist';
				break;
			case '7':$case='convenio does not belong to current empresa resource';
				break;
			case '701':$case='produtofatura does not exist';
				break;
			case '702':$case='produtofatura does not belong to current convenio resource';
				break;
			case '703':$case='fatura does not exist';
				break;
			case '704':$case='fatura does not belong to current convenio resource';
				break;
			case '8':$case='funcionario does not exist';
				break;
			case '9':$case='funcionario does not belong to current empresa resource';
				break;
			case '901':$case='resumoatividade does not exist';
				break;
			case '902':$case='resumoatividade does not belong to current funcionario resource';
				break;
			case '10':$case='resumofinanceiro does not exist';
				break;
			case '11':$case='resumofinanceiro does not belong to current empresa resource';
				break;
			case '12':$case='resumoempresacliente does not exist';
				break;
			case '13':$case='resumoempresacliente does not belong to current empresa resource';
				break;
			case '14':$case='caminhao does not exist';
				break;
			case '15':$case='caminhao does not belong to current empresa resource';
				break;
		}
		$d=new StandardResponse;
		$mssg=$d->responsedata(
			'empresa',
			false,
			'resource',
			$case
			)
		;
		$response=Response::json($mssg,400);
	}
	return $response;
	
});

Route::filter('classe',function($route,$request){
	$response=null;
	$case=0;
	if (!null==$route->getParameter('classe')) {
		$classe_id=$route->getParameter('classe');
		$classe=Classe::find($classe_id);
		if ($classe==null) {
			$case=1;//classe does not exist
		} else {
			if (!null==$route->getParameter('subclasse')) {
				$subclasse_id=$route->getParameter('subclasse');
				$subclasse=Subclasse::find($subclasse_id);
				if ($subclasse==null) {
					$case=2;//subclasse does not exist
				} else if ($subclasse->classe_id!=$classe_id) {
					$case=3;//subclasse does not belong to classe
				}
			}
		}
		if ($case>0) {
			switch ($case) {
				case 1:$case='classe does not exist';break;
				case 2:$case='subclasse does not exist';break;
				case 3:$case='subclasse does not belong to classe';break;
			}
			$d=new StandardResponse;
			$mssg=$d->responsedata(
				'classe',
				false,
				'resource',
				$case
				)
			;
			$response=Response::json($mssg,400);
		}
	}
	#
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
