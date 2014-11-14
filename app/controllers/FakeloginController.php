<?php

/**
* WARNING!!!
* 
* HIGH SECURITY THREATS IF INCLUDED IN THE PRODUCTION ENVIRONMENT
* 
* THIS CONTROLLER SHOULD NOT BE INCLUDED IN THE PRODUCTION
* ENVIRONMENT !!!
* 
* ONLY FOR TESTING PURPOSES!!!
* 
* This controller allows tester user to start different
* types of loggin processes, such as being an administrator
* or a company user.
* 
* This controller SKIPS ANY SECURITY BARRIER, so it is very
* advisable to constantly verify not being included 
* in the production environment.
* 
* 
* 
*/
/**
 * [Table]Data class only contains data related to
 * the table 
 */
class LoginData extends StandardResponse{
	/** 
	* function name: header.
	* @param header with headers of empresa table
	*/
	public function header(){
		/*
		$header= headers on table empresas
		In order to display or hide on HTML table, set as
		1 (visible) or 2 (not shown)
		*/
		$header=array(	
			array('nome',1)
			,array('email',1)
			,array('login',1)
		);

		return $header;
	}
	
	/**
	* @param edata retrieves all data from table "empresa"
	*/
	public function edata () {
		return Login::all();
	}

	public function show($id){
		return Login::find($id);
	}

	/**
	* @param formdata returns array with form values
	*/
	public function form_data(){

		return array(
				/*'nome'		=>Input::get('nome'),
				'regiao'			=>Input::get('regiao')*/
				)
		;
	}

	public function validrules(){
		return array(
			//'nome'	=>	'required'
			//,'regiao'		=>	'required'
			)
		;
	}

}


class FakeloginController extends \BaseController {

	public function postLogin () {
		/**
		* Login function: simulates the whole
		* login process, no need to enter
		* values in a login form
		* user name: same sent on profile
		* Password: same user name
		*/
		$u=Input::get('id');
		//
		//checking if admin_cacambas profile exists
		if (Perfil::whereNome('admin_cacambas')->count()==0) {
			$p=new Perfil;
			//$p->perfil_id_pai=7;
			$p->nome='admin_cacambas';
			$p->descricao='Superuser adminstrator profile';
			$p->status=1;
			$p->save();
		} 
		//
		//checking if company profile exists
		if (Perfil::whereNome('company')->count()==0) {
			$p=new Perfil;
			//$p->perfil_id_pai=8;
			$p->nome='company';
			$p->descricao='Company profile, user can access only to company he works for';
			$p->status=1;
			$p->save();
		}

		//$perfil=Perfil::find($p_id)
		
		$l=Login::whereLogin($u)->first();
		//Setting variables for desired profile
		if ($u=='superuser') {
			$company=1;
			$perfil=Perfil::whereNome('admin_cacambas')->first()->id;
		} else if ($u=='empresa3user') {
			$company=3;
			$perfil=Perfil::whereNome('company')->first()->id;
		}
		if ($l==null) {
			$l_i=new Login;
			$l_i->empresa_id=$company;
			$l_i->nome=$u;
			$l_i->login=$u;
			$l_i->senha=Hash::make($u);
			$l_i->status=1;
			$l_i->save();
			$user_id=$l_i->id;
			//
			//Cleaning DB from probable old inputs
			//
			$l_p=Loginperfil::whereLogin_id($user_id);
			if (Loginperfil::whereLogin_id($user_id)->count()>0) {
				$l_p->delete();
			}

			//Creating login perfil pivot relationship
			$lp=new Loginperfil;
			$lp->login_id=$user_id;
			$lp->perfil_id=$perfil;
			$lp->status=1;
			$lp->save();
		}
		//Empresa id 9999 will contain superusers
		if (Empresa::find(9999)==null) {
			$e=new Empresa;
			$e->id=9999;
			$e->nome='Planet Express';
			$e->nome_fantasia='Super Planet Express corporation';
			$e->cnpj='';
			$e->insc_estadual='';
			$e->responsavel='Diego Antunes';
			$e->email='cacambas@cacambas.com';
			$e->telefone='12345';
			$e->celular='1234509876';
			$e->observacao='nope';
			$e->afiliado=1;
			$e->save();
		}

		//Empresa id 3 will contain "regular" user
		if (Empresa::find(3)==null) {
			$e=new Empresa;
			$e->id=3;
			$e->nome='Three corporation';
			$e->nome_fantasia='Regular company with regular users';
			$e->cnpj='';
			$e->insc_estadual='';
			$e->responsavel='Diego Antunes';
			$e->email='e3@empresa.com';
			$e->telefone='12345';
			$e->celular='1234509876';
			$e->observacao='nope';
			$e->afiliado=1;
			$e->save();
		}

		if (Auth::attempt(array('login' => $u, 'password' => $u, 'status' => 1)))
		{
			return 1;//Redirect::to('myproduction');
		}
	}

	public function getLogout () {
		Auth::logout();
		return Redirect::to('myproduction');
	}

	/**
	 * Display a listing of the resource.
	 * GET /fakelogin
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		return Login::all();
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /fakelogin/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /fakelogin
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /fakelogin/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /fakelogin/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /fakelogin/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /fakelogin/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}