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

		/**
		* 1. Setting enviroment for FIRST TIME INVOICE
		* (first time "fatura")
		* @param dt_inicio_date_format 
		* @param first_dia_fatura_date_format
		* @param invoice_due_date
		*/
		$dia_fatura=$convenio->dia_fatura;
		//data_vencimiento for first time invoice
		$dt_inicio_year=substr($convenio->dt_inicio, 0,4);
		$dt_inicio_month=substr($convenio->dt_inicio, 5,2);
		$dt_inicio_day=substr($convenio->dt_inicio, 8,2);

		//dates must be converted in php date format for
		//proper dates calculations
		$dt_inicio_date_format=
		date(
			'Y-m-d',
			//mktime(hour,minute,second,month,day,year,is_dst);
			mktime(
				0,
				0,
				0,
				$dt_inicio_month,
				$dt_inicio_day,
				$dt_inicio_year
				)
			)
		;
		$dt_inicio_strtotime_format=strtotime($dt_inicio_date_format);
		$first_dia_fatura_date_format=
		date(
			'Y-m-d',
			//mktime(hour,minute,second,month,day,year,is_dst);
			mktime(
				0,
				0,
				0,
				$dt_inicio_month,
				$dia_fatura, //dia fatura!!
				$dt_inicio_year
				)
			)
		;
		$period_due_date_month=
		date('Y-m-d',strtotime('+1 month',$dt_inicio_strtotime_format));
		$period_due_date_semester=
		date('Y-m-d',strtotime('+6 month',$dt_inicio_strtotime_format));
		$period_due_date_year=
		date('Y-m-d',strtotime('+1 year',$dt_inicio_strtotime_format));
		$invoice_due_date;
		if (
			$first_dia_fatura_date_format
			<
			$dt_inicio_date_format
			) 
		{
			$first_dia_fatura_date_format=
			strtotime($first_dia_fatura_date_format);

			//
			$invoice_due_date=
			date(
				'Y-m-d',
				strtotime(
					"+1 month",
					$first_dia_fatura_date_format
					)
				)
			;
		} else {
			$invoice_due_date=$first_dia_fatura_date_format;
		}
		$plano_total=$convenio->plano->valor_total;
		$plano_percent_disconto=$convenio->plano->valor_desconto;
		$plano_desconto=$convenio->plano->percentual_desconto;
		$final_valor_plano=
		$plano_total-(
			$plano_desconto+
			($plano_total*$plano_percent_disconto)
			)
		;
		return 
		View::make(
			'tempviews.convenioFatura.create',
			compact(
				'empresa_id',
				'c_id',
				'convenio',
				'count_fatura',
				'dt_inicio_date_format',
				'period_due_date_month',
				'period_due_date_semester',
				'period_due_date_year',
				'first_dia_fatura_date_format',
				'invoice_due_date',
				'plano_total',
				'plano_percent_disconto',
				'plano_desconto',
				'final_valor_plano'
				)
			)
		;
	}

	public function store ($c_id) {
		$convenio=Convenio::find($c_id);
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