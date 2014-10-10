<?php 

function dateadjustment(
	$c,
	$starting_period_date,
	$period_due_date_month,
	$period_due_date_semester,
	$period_due_date_year
	){
	if ($c->ativado==1&&$c->produto->servico==1) {
		$active_service_mes=false;
		$active_service_semestre=false;
		$active_service_ano=false;
		// startdate of service
		//conditions for products as true
		//for current invoice
		//1. data_ativacao < $ending_period_date
		//2. data_desativacao > $starting_period_date
		//3. If data_ativacao < $starting_period_date
		//   invoice will count only from starting date
		//4. If data_desativacao =null or > 
		//    $ending_period_date invoice will go until
		//    $ending_period_date
		if (strtotime($c->data_desativacao)>strtotime($starting_period_date)
		||$c->data_desativacao==null) {
			if ($c->data_ativacao<$period_due_date_month) {
				$active_service_mes=true;
				$numberofmonths=1;
			}
			else if ($c->data_ativacao<$period_due_date_semester) {
				$active_service_semestre=true;
				$numberofmonths=6;
			}
			else if ($c->data_ativacao<$period_due_date_year) {
				$active_service_ano=true;
				$numberofmonths=12;
			}
		}
		/**
		* PERIOD INTERVAL ADJUSTMENTS
		* Formulas that check number of days inside a billing period.
		* 
		* For instance, as each month contains different number of days 
		* [28,29,30,31], intervals must be calculated base on date differences
		* instead of just multiplyinig number of months by 30 days.
		* Even the year interval should be calculated as for leap years
		* inverval corresponds to 366 days (every 4 years) instead of 365.
		*/
		//
		//Month interval setup
		$month_interval=strtotime($period_due_date_month)-strtotime($starting_period_date);
		$month_interval=floor($month_interval/(60*60*24) );
		//
		//Semester interval setup
		$semester_interval=strtotime($period_due_date_semester)-strtotime($starting_period_date);
		$semester_interval=floor($semester_interval/(60*60*24) );
		//
		//Year interval setup
		$ano_interval
		=strtotime($period_due_date_year)-strtotime($starting_period_date);
		$ano_interval=floor($ano_interval/(60*60*24) );
		//
		//Discount adjustment
		$day_m=($c->produto->valor -($c->desconto_percentual*$c->produto->valor/100))/$month_interval;
		$day_s=(($c->produto->valor -($c->desconto_percentual*$c->produto->valor/100) )*6)/$semester_interval;
		$day_y=(($c->produto->valor -($c->desconto_percentual*$c->produto->valor/100) )*12)/$ano_interval;
		//
		//
		/**
		* STARTING DATE SETUP FOR SERVICES
		* The first day of a service is not necessarily the first fatura
		* date, as service might be activated after the plan activation date.
		* So, service start date should be set according to relationships
		* between the invoice start date and the service activation date.
		*/
		$starting_period_date_timeformat=strtotime($starting_period_date);
		$activatedate_timeformat=strtotime($c->data_ativacao);
		/**
		* First condition: if the activation service date is older than the 
		* billing starting period date, the start date included in the
		* billing will be the billing start period instead 
		* of the service activation date.
		*
		*/
		if ( $starting_period_date_timeformat > $activatedate_timeformat ) {
			$first_day=$starting_period_date;
		}
		/**
		* Second condition: if the activation service date is more recent than the 
		* billing starting period date, the start date included in the
		* billing will be the billing activation service date instead 
		* of the billing starting period date.
		*
		*/
		else {
			$first_day=$c->data_ativacao;
		}
		/**
		* ENDING DATE SETUP FOR SERVICES
		* The last day to be billed from a purchased service should be set
		* as the service deactivation date can be null or greater to the
		* billing period.
		* So, service end date should be set according to relationships
		* between the invoice end date and the service deactivation date.
		*
		* First condition: if the deactivation service date is greater than the 
		* billing end period date, the end date included in the
		* billing will be the billing end period instead 
		* of the service deactivation date.
		* 
		* Second condition: if the deactivation service date is more recent than the 
		* billing ending period date, the end date included in the
		* billing will be the billing deactivation service date instead 
		* of the billing ending period date.
		*
		*/
		//Changing date string format to timeformat, in order to allow math calculations
		$desactivacao_timeformat=strtotime($c->data_desativacao);
		$last_day_month_dateformat=strtotime($period_due_date_month);
		//Condition for month
		if ($desactivacao_timeformat>$last_day_month_dateformat
			||
			$c->data_desativacao==null
			) {
			$lastday_m=$period_due_date_month;
		}
		else {
			$lastday_m=$c->data_desativacao;
		}
		//Condition for semester
		$last_day_semester_dateformat=strtotime($period_due_date_semester);
		if ($desactivacao_timeformat>$last_day_semester_dateformat
			||
			$c->data_desativacao==null
			) {
			$lastday_s=$period_due_date_semester;
		}
		else {
			$lastday_s=$c->data_desativacao;
		}
		//Condition for year
		$last_day_year_dateformat=strtotime($period_due_date_year);
		if ($desactivacao_timeformat>$last_day_year_dateformat
			||
			$c->data_desativacao==null
			) {
			$lastday_y=$period_due_date_year;
		}
		else {
			$lastday_y=$c->data_desativacao;
		}
		/**
		* Number of days to be billed: since many services can start
		* after the first billed day or can stop before the last billed
		* day, the number of days to be billed should be calculated
		* and price should be proportionally charged to the invoice.
		*/
		$month_diff=(strtotime($lastday_m)-strtotime($first_day))/(60*60*24);
		$semester_diff=(strtotime($lastday_s)-strtotime($first_day))/(60*60*24);
		$year_diff=(strtotime($lastday_y)-strtotime($first_day))/(60*60*24);
		$definitive_service_price_m=$month_diff*$day_m;
		$definitive_service_price_s=$semester_diff*$day_s;
		$definitive_service_price_y=$year_diff*$day_y;
	}
	return array(
		'am'			=>	$active_service_mes,
		'as'			=>	$active_service_semestre,
		'ay'			=>	$active_service_ano,
		'fd'			=>	$first_day,
		'lm'			=>	$lastday_m,
		'ls'			=>	$lastday_s,
		'ly'			=>	$lastday_y,
		'mdif'			=>	$month_diff,
		'sdif'			=>	$semester_diff,
		'ydif'			=>	$year_diff,
		'm_intv'		=>	$month_interval,
		's_intv'		=>	$semester_interval,
		'y_intv'		=>	$ano_interval,
		'def_price_m'	=>	$definitive_service_price_m,
		'def_price_s'	=>	$definitive_service_price_s,
		'def_price_y'	=>	$definitive_service_price_y
		)
	;
}

?>