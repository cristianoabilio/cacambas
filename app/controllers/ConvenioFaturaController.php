<?php

class DateFixer {
	//
	/** 
	* function name: plusOneMonth.
	* @return given date in 'Y-m-d' format plus one month
	*/
	public function replaceDay($date,$day) {
		$dt_inicio_year=substr($date, 0,4);
		$dt_inicio_month=substr($date, 5,2);
		$dt_inicio_day=substr($date, 8,2);

		$replaced_day=date('Y-m-d',
			mktime(
				0,
				0,
				0,
				$dt_inicio_month,
				$day, //dia fatura!!
				$dt_inicio_year
				)
			)
		;

		return $replaced_day;
	}
}

class ConvenioFaturaData extends StandardResponse{
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
			//,array('mes_referencia',0)
			//,array('semestre_referencia',0)
			//,array('ano_referencia',0)
			,array('plan_period_start_date',1)
			,array('plan_period_end_date',1)
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

	public function formatdata(){
		$formdata=array(
			'plan_period_start_date'=>Input::get('plan_period_start_date'),
			'plan_period_end_date'	=>Input::get('plan_period_end_date'),
			'data_vencimento'		=>Input::get('data_vencimento'),
			'data_pagamento'		=>Input::get('data_pagamento'),
			'forma_pagamento'		=>Input::get('forma_pagamento'),
			'status_pagamento'		=>Input::get('status_pagamento'),
			'valor_plano'			=>Input::get('valor_plano'),
			'valor_prod_compra'		=>Input::get('valor_prod_compra'),
			'valor_prod_uso'		=>Input::get('valor_prod_uso'),
			'valor_boleto'			=>Input::get('valor_boleto'),
			'valor_total'			=>Input::get('valor_total'),
			'ajuste_tipo'			=>Input::get('ajuste_tipo'),
			'ajuste_valor'			=>Input::get('ajuste_valor'),
			'ajuste_percentual'		=>Input::get('ajuste_percentual'),
			'pagarme'				=>Input::get('pagarme')
			)
		;
		return $formdata;
	}

	public function validrules() {
		return array(
			'plan_period_end_date'=>'required'
			)
		;
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


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create ($c_id) {
		$fake=new fakeuser;
		$df=new DateFixer;
		$empresa_id=$fake->empresa();
		$convenio=Convenio::find($c_id);
		$count_fatura=Fatura::whereConvenio_id($c_id)
		->count();

		/**
		* 1. Setting enviroment for FIRST TIME INVOICE
		* (first time "fatura")
		* @param first_dia_fatura_date_format
		* @param invoice_due_date
		*/
		if ($count_fatura==0) {
			$starting_period_date=$convenio->dt_inicio;
			$dia_fatura=$convenio->dia_fatura;
			//php date format conversion for
			//calculations between dates
			$dt_inicio_strtotime_format=strtotime($convenio->dt_inicio);

			$first_dia_fatura_date_format=$df->replaceDay($convenio->dt_inicio,$dia_fatura);
			
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
				$convenio->dt_inicio
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
			//
		} else {
			$starting_period_date=
					Fatura::whereConvenio_id($convenio->id)
					->where(function($query){
						$query->max('data_vencimento');
					})
					->first()->data_vencimento;
				$invoice_due_date=$first_dia_fatura_date_format;
		}

			
			
		$plano_total=//1000000
		$convenio->plano->valor_total
		;
		$plano_percent_disconto=//10
		$convenio->plano->valor_desconto
		;
		$plano_desconto=//20
		$convenio->plano->percentual_desconto
		;
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
				'starting_period_date',
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
		//
		//instantiate fake user (for empresa and sessao)
		//SHOULD BE DELETED IN ORIGINAL PROJECT
		$fake=new fakeuser;

		$d=new ConvenioFaturaData;

		$success=$d->formatdata();
		try {
			$validator= Validator::make(
				Input::All(),
				$d->validrules(),
				array(
					'required'=>'Required field'
					)
				)
			;
			
			$e=new Fatura;
			$e->convenio_id			=$c_id;
			foreach ($success as $key => $value) {
				$e->$key 	=$value;
			}
			//
			$e->NFSe				=1;
			$e->dthr_cadastro		=date('Y-m-d');

			$e->sessao_id			=$fake->sessao_id();
			$e->save();

			$success['id']=$e->id;

			$res=$d->responsedata(
				'fatura',
				true,
				'store',
				$success
				)
			;
			$code=200;

		} catch (Exception $e) {
			SysAdminHelper::NotifyError($e->getMessage());
			$res=$d->responsedata(
				'fatura',
				false,
				'store',
				$validator->messages()
				)
			;
			$code=400;
		}
		return Response::json($res,$code);
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