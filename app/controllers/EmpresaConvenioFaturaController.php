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

class EmpresaConvenioFaturaData extends StandardResponse{
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
			//array('convenio_id',1)
			//,array('empresa_id',0)
			//,array('mes_referencia',0)
			//,array('semestre_referencia',0)
			//,array('ano_referencia',0)
			//,
			array('plan_period_start_date',1)
			,array('plan_period_end_date',1)
			,array('data_vencimento',1)
			,array('data_pagamento',1)
			,array('forma_pagamento',0)
			,array('status_pagamento',0)
			,array('valor_plano',0)
			//,array('valor_prod_compra',0)
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

	public function form_data(){
		$formdata=array(
			'plan_period_start_date'=>Input::get('plan_period_start_date'),
			'plan_period_end_date'	=>Input::get('plan_period_end_date'),
			'data_vencimento'		=>Input::get('data_vencimento'),
			'data_pagamento'		=>Input::get('data_pagamento'),
			'forma_pagamento'		=>Input::get('forma_pagamento'),
			'status_pagamento'		=>Input::get('status_pagamento'),
			'valor_plano'			=>Input::get('valor_plano'),
			//'valor_prod_compra'		=>Input::get('valor_prod_compra'),
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
			'plan_period_end_date'=>'required | date',
			'forma_pagamento'=>'required |integer',
			'status_pagamento'=>'required | integer',
			'valor_plano'=>'required |numeric',
			'valor_prod_uso'=>'required |  numeric',
			'valor_boleto'=>'required |numeric',
			'valor_total'=>'required |  numeric'
			)
		;
	}
}
//array('')

class EmpresaConvenioFaturaController extends BaseController{

	public function __construct(){
		$this->beforeFilter('csrf', array('on' => 'post'));
		$this->beforeFilter('empresa');
	}

	public function index ($empresa_id,$convenio_id) {
		$d=new EmpresaConvenioFaturaData;
		return $d->edata($convenio_id);
	}

	public function visible ($empresa_id,$convenio_id) {
		$fake=new fakeuser;
		$d=new EmpresaConvenioFaturaData;
		
		$header=$d->header();
		$fatura=$d->edata($convenio_id);
		return View::make(
			'tempviews.EmpresaConvenioFatura.index',
			compact(
				'header',
				'fatura',
				'empresa_id',
				'convenio_id'
				)
			)
		;
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create ($empresa_id,$convenio_id) {
		//Fakeuser can be removed later, as
		//it simulates a logged user
		$fake=new fakeuser;

		//Datefixer class contains some date calculations and functions
		$df=new DateFixer;

		//$empresa_id can be replaced with real empresa id
		//for logged users
		$empresa_id=$fake->empresa();

		//Required variable.
		$convenio=Convenio::find($convenio_id);
		$count_fatura=Fatura::whereConvenio_id($convenio_id)
		->count();

		$sumofproductusage_mes 		=0;
		$sumofproductusage_semestre =0;
		$sumofproductusage_ano 		=0;

		/**
		* STARTING DATE INVOICE
		* Setting the date that will be used as the 
		* invoice start day.
		* @param starting_period_date: invoice start day
		*/
		//
		//First time invoice
		if ($count_fatura==0) {
			$starting_period_date=$convenio->dt_inicio;
		} 
		//
		//Already existant invoice
		else {
			$starting_period_date=
			Fatura::whereConvenio_id($convenio->id)
			->where(function($query){
				$query->max('plan_period_end_date')
				;
			}
			)
			->first()->plan_period_end_date;
			$starting_period_date=date('Y-m-d',strtotime($starting_period_date.'+1 day'));
			//$starting_period_date=date('Y-m-d',strtotime($starting_period_date+0));
		}
		//$starting_period_datetime contains the core date to do 
		//date calculations related to first time or consecutive invoices
		$starting_period_datetime=strtotime($starting_period_date);

		//
		$dia_fatura=$convenio->dia_fatura;

		//php date format conversion to time format required on
		//calculations between dates
		$dt_inicio_strtotime_format=strtotime($convenio->dt_inicio);

		//
		$first_dia_fatura_date_format=$df->replaceDay($starting_period_date,$dia_fatura);
		$first_dia_fatura_datetime_format=strtotime($first_dia_fatura_date_format);
		

		//Invoice end dates for month, semester and year
		$period_due_date_month=
		date('Y-m-d',strtotime('+1 month',$starting_period_datetime));
		$period_due_date_semester=
		date('Y-m-d',strtotime('+6 month',$starting_period_datetime));
		$period_due_date_year=
		date('Y-m-d',strtotime('+1 year',$starting_period_datetime));
		//

		//Invoice date limit payment
		if (
			$first_dia_fatura_datetime_format
			<
			$starting_period_datetime
			) 
		{
			//
			$invoice_due_date=
			date(
				'Y-m-d',
				strtotime(
					"+1 month",
					$first_dia_fatura_datetime_format
					)
				)
			;
		} else {
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
			'tempviews.EmpresaConvenioFatura.create',
			compact(
				'empresa_id',
				'convenio_id',
				'convenio',
				'count_fatura',
				'sumofproductusage_mes',
				'sumofproductusage_semestre',
				'sumofproductusage_ano',
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

	public function store ($empresa_id,$convenio_id) {
		//
		//instantiate fake user (for empresa and sessao)
		//SHOULD BE DELETED IN ORIGINAL PROJECT
		$fake=new fakeuser;

		$d=new EmpresaConvenioFaturaData;

		$success=$d->form_data();
		try {
			$validator= Validator::make(
				Input::All(),
				$d->validrules(),
				array(
					'required'=>'Required field'
					)
				)
			;
			if ($validator->fails()){
				throw new Exception(
					json_encode(
						array(
							'validation_errors'=>$validator->messages()->all()
							)
						)
					)
				;
			}
			
			$e=new Fatura;
			$e->convenio_id			=$convenio_id;
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

	public function show ($empresa_id,$convenio_id,$id) {
		$d=new EmpresaConvenioFaturaData;
		return $d->show($id);
	}
	public function showvisible ($empresa_id,$convenio_id,$id) {
		$d=new EmpresaConvenioFaturaData;
		
		$header=$d->header();
		$fatura=$d->show($id);
		return View::make(
			'tempviews.EmpresaConvenioFatura.show',
			compact(
				'header',
				'fatura',
				'empresa_id',
				'convenio_id',
				'id'
				)
			)
		;
	}

	public function edit ($empresa_id,$convenio_id,$id) {

		$d=new EmpresaConvenioFaturaData;

		$fatura=$d->show($id);

		return View::make(
			'tempviews.EmpresaConvenioFatura.edit',
			compact(
				'fatura',
				'empresa_id',
				'convenio_id',
				'id'
				)
			)
		;
	}

	public function update ($empresa_id,$convenio_id,$id) {
		
	}

	public function destroy ($empresa_id,$convenio_id,$id) {
		
	}

}