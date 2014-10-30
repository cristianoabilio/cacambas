<?php

class StoreErrorTest extends TestCase {
	//
	/**
	* THIS TEST SIMULATES AN EMPTY 'POST' ACTION ON EACH
	* RESTFULL CONTROLLER REQUIRED FOR THE PLANET-EXPRESS PROJECT
	* Expected output is a standard json string success message store error
	* and a 400 status response
	*/
	public function errorResponse($err)
	{
		$response=$this->call('POST','/'.$err);
		$expected='{"success":false,"message":"'.$err.'-store-error"';

		//Checkinge page content containing expected JSON string
		$this->assertContains($expected,$response->getContent() );

		//checking a 400 status response
		$this->assertResponseStatus(400);
		
	}

	public function testStoreClasse () {
		$this->errorResponse('classe');
	}

	//Subclasse cannot be created from its "Subclase/create" as is nested
	//to Classe

	public function testStoreCompras () {
		$this->errorResponse('compras');
	}

	//Contabancaria cannot be created from its "Contabancaria/create" as is nested
	//to Empresa controller

	//Convenio cannot be created from its "Contabancaria/create" as is nested
	//to Empresa controller

	public function testStoreEmpresa () {
		$this->errorResponse('empresa');
	}

	//Limite cannot be created from its "limite/create" route as is nested
	//to Plano or Convenio controller

	public function testStorePlano () {
		$this->errorResponse('plano');
	}

	public function testStoreProduto () {
		$this->errorResponse('produto');
	}

}


