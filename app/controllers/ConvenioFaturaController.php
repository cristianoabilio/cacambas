<?php

class ConvenioFaturaData{
	/** 
	* function name: header.
	* @param header with headers of convenio table
	*/
	public function header(){
		/*
		$header= headers on table 
		In order to display or hide on HTML table, set as
		1 (visible) or 0 (not shown)
		*/
		$header=array(	
			array('convenio_id',1)
			,array('empresa_id',0)
			,array('mes_referencia',0)
			,array('semestre_referencia',0)
			,array('ano_referencia',0)
			,array('data_vencimento',1)
			,array('data_pagamento',1)
			,array('forma_pagamento',0)
			,array('status_pagamento',0)
			,array('valor_plano',0)
			,array('valor_prod_compra',0)
			,array('valor_prod_uso',0)
			,array('valor_boleto',0)
			,array('valor_total',1)
			,array('ajuste_tipo',0)
			,array('ajuste_valor',0)
			,array('ajuste_percentual',0)
			,array('pagarme',0)
			,array('NFSe',0)
			,array('dthr_cadastro',0)
			,array('sessao_id',0)
			)
		;	
		return $header;
	}

	/**
	* @return edata retrieves all "fatura" related to "convenio"
	*/
	public function edata($id){
		return Convenio::find($id)->fatura;
	}

	public function show ($id) {
		return Fatura::find($id);
	}
}

class ConvenioFaturaController extends BaseController{

	public function index ($c_id) {
		$fake=new fakeuser;
		$d=new ConvenioFaturaData;
		$data=array(
			'header' 		=>$d->header(),
			'empresa'		=>$fake->empresa(),
			'convenio_id' 	=>$c_id,
			'fatura'		=>$d->edata($c_id)
			)
		;
		return View::make('tempviews.convenioFatura.index',$data);
	}

	public function create ($c_id) {
		$fake=new fakeuser;
		$empresa_id=$fake->empresa();
		$convenio=Convenio::find($c_id);
		$count_fatura=Fatura::whereConvenio_id($c_id)
		->count();
		//data_vencimiento 
		return 
		View::make(
			'tempviews.convenioFatura.create',
			compact(
				'empresa_id',
				'c_id',
				'convenio',
				'count_fatura'
				)
			)
		;
	}

	public function store ($c_id) {
		$convenio=Convenio::find($_c);
		return Input::all();
	}

	public function show ($c_id,$f_id) {
		$d=new ConvenioFaturaData;
		$data=array(
			'header' 		=>$d->header(),
			'convenio_id'	=>$c_id,
			'fatura'		=>$d->show($f_id),
			'fatura_id'		=>$f_id
			)
		;
		return View::make('tempviews.convenioFatura.show',$data);
	}

	public function edit ($c_id,$f_id) {
		$data=array(
			)
		;
		return View::make('tempviews.convenioFatura.edit',$data);
	}

	public function update ($c_id,$f_id) {
		
	}

	public function destroy ($c_id,$f_id) {
		
	}

}