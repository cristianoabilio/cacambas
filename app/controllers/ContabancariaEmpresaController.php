<?php 


//ContabancariaEmpresaController
class ContabancariaEmpresaController extends \BaseController {
	public function getIndex () {
		$fake=new fakeuser;
		
		$h=new contabancariaheader;

		$empresa=$fake->empresa();

		$conta=$h->edataempresa( $empresa );
		
		return $conta;
	}
}