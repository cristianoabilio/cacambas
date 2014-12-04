<?php

class EmpresaCustoData extends StandardResponse{
	/** 
	* function name: header.
	* @param header with headers of convenio table
	*/
	public function header(){
		/*
		$header= headers on table
		In order to display or hide on HTML table, set as
		1 (visible) or 2 (not shown)
		*/
		$header=array(
			//Custo table headers
			array('dt_inicio',1)
			,array('dt_fim',0)
			,array('valor_total',0)
			,array('status_financeiro',0)
			,array('detail_detalhe',0)
			,array('detail_prestadora',0)
			,array('detail_descricao',0)

			//custodetail headers
			,array('detail_detalhe',1)
			,array('detail_prestadora',0)
			,array('detail_descricao',0)
			,array('detail_observacao',0)
			)
		;	
		return $header;
	}

	//$custoheaders: column names on custo table
	public $custoheaders=array(
		'id',
		'dt_inicio',
		'dt_fim',
		'dt_pagamento',
		'valor_total',
		'valor_pago',
		'status_financeiro',
		'status_custo',
		'sessao_id',
		'empresa_id'
		)
	;

	//$detailsheader column names on custodetails table
	public $detailsheader=array(
		'id',
		'detalhe',
		'prestadora',
		'descricao',
		'observacao'
		)
	;

	//$custogrouperheader column names on custogroupers table
	public $custogrouperheader=array(
		'custogroup'=>'fkname'
		)
	;
	
	/**
	* @param edata retrieves all data from table "limite"
	*/
	public function edata ($empresa_id) {

		//$data: all custos for empresa resource
		$data=Empresa::find($empresa_id)->custo;

		//$wholecusto: all custos depending on custoheader;
		$wholecusto=array();
		$i=0;
		foreach ($data as $key => $c) {

			//custogrouperheader only contains "fkname" value
			foreach ($this->custogrouperheader as $ck => $cv) {

				//cg_name contains the array value "fkname"
				//stored in register -caminhao, funcionario, equipamento-
				$cg_name=$c->custogrouper->$cv;

				//adding 'fkname' to array with its value
				$wholecusto[$i][$ck]=$cg_name;

				//custogroup_identifier_name ($key) contains the column that is
				//displayed on json object, according to fkname.
				//caminhao is fetched with "placa", funcionario
				//with "username" and equipamentodetail with "id"
				$wholecusto[$i]['custogroup_identifier_name']='';

				//custogroup_identifier_value ($key) contains value
				//according to identifier name (previous comment)
				$wholecusto[$i]['custogroup_identifier_value']='';

				//Query for caminhao fkname value, retrieving "placa" value
				if ($cg_name=='caminhao') {
					$resource=Caminhao::find($c->custogrouper->fkid)->placa;
					$wholecusto[$i]['custogroup_identifier_name']='placa';
					$wholecusto[$i]['custogroup_identifier_value']=$resource;
				} 
				//Query for funcionario fkname value, retrieving "username" value
				else if ($cg_name=='funcionario') {
					$resource=Funcionario::find($c->custogrouper->fkid)->login->login;
					$wholecusto[$i]['custogroup_identifier_name']='username';
					$wholecusto[$i]['custogroup_identifier_value']=$resource;
				} 
				//Query for equipamentodetail fkname value, retrieving "id" value
				else if ($cg_name=='equipamento') {
					$resource=Equipamentodetail::find($c->custogrouper->fkid)->id;
					$wholecusto[$i]['custogroup_identifier_name']='id';
					$wholecusto[$i]['custogroup_identifier_value']=$resource;
				}
			}

			//retrieving custos values on custos table
			foreach ($this->custoheaders as $v) {
				$wholecusto[$i][$v]=$c->$v;
			}

			//retrieving custodetails values on custodetails table
			foreach ($this->detailsheader as $vd) {
				$wholecusto[$i]['detail_'.$vd]=$c->custodetail->$vd;
			}

			//adding subclasse and classe custos type -fixed, variable, etc-
			$wholecusto[$i]['subclasse_nome']=$c->custodetail->subclasse->nome;
			$wholecusto[$i]['classe_nome']=$c->custodetail->subclasse->classe->nome;
			$i++;
		}
		return $wholecusto;
	}

	public function show($id){
		$data=Custo::find($id);
		$custo=array();
		$custo['custogroup_identifier_name']='';
		$custo['custogroup_identifier_value']='';
		foreach ($this->custogrouperheader as $ck => $cv) {
			$cg_name=$data->custogrouper->$cv;
			$custo[$ck]=$cg_name;
			if ($cg_name=='caminhao') {
				$resource=Caminhao::find($data->custogrouper->fkid)->placa;
				$custo['custogroup_identifier_name']='placa';
				$custo['custogroup_identifier_value']=$resource;
			} else if ($cg_name=='funcionario') {
				$resource=Funcionario::find($data->custogrouper->fkid)->login->login;
				$custo['custogroup_identifier_name']='username';
				$custo['custogroup_identifier_value']=$resource;
			} else if ($cg_name=='equipamento') {
				$resource=Equipamentodetail::find($data->custogrouper->fkid)->id;
				$custo['custogroup_identifier_name']='id';
				$custo['custogroup_identifier_value']=$resource;
			}
		}
		
		foreach ($this->custoheaders as $v) {
			$custo[$v]=$data->$v;
		}
		foreach ($this->detailsheader as $vd) {
			$custo['detail_'.$vd]=$data->custodetail->$vd;
		}
		$custo['subclasse_nome']=$data->custodetail->subclasse->nome;
		$custo['classe_nome']=$data->custodetail->subclasse->classe->nome;
		

		return $custo;
	}

	/**
	* -----------------------------
	* Columns for custogrouper
	* -----------------------------
	* custotype for fk name.  Must be replaced=
	*   - caminhao 						caminhao
	*   - equipamento 					equipamentodetail
	*   - funcionarioLogin 				funcionario
	* custotypeselect
	* 
	*/
	public function custogrouper_form_data(){
		$fillable=array();
		$nullable=array(
			//custotype: select input [name].  It contains 
			// "0, caminhao,equipamento,funcionarioLogin" 
			//as options.
			'custotype' 

			//custotypeselect: select input [name].  Contains
			//ajax response with options for each case on
			//table to be associated, whether is "caminhao",
			//"funcionario" or "equipamentodetail".
			//Values on ajax response are the ids of
			//records in where custos will be set.
			,'custotypeselect' 
			)
		;
		//data to be stored (updated), in custogroupers table
		$raw_custogrouper= $this->formCapture ($fillable,$nullable);
		//$custogrouper=array();
		$custogrouper['fkname']=$raw_custogrouper['custotype'];
		$custogrouper['fkid']=$raw_custogrouper['custotypeselect'];
		return $custogrouper;
	}

	/**
	* -----------------------------
	* Columns for custodetail 
	* -----------------------------
	* 
	*/
	public function custodetail_form_data(){
		$fillable=array(
			'subclasse_id',
			'detalhe'
			)
		;
		$nullable=array(
			'prestadora',
			'descricao',
			'observacao'
			)
		;
		//data to be stored (updated), in custodetails table
		/**
		* formCapture method converts fillable items in
		* array 'item_1' => Input::get('item_1'),
		*       'item_n' => Input::get('item_n') 
		* and if Input::get('nullable') is not empty
		* nullable item is added inside the array
		* @return array
		*
		*/
		return $this->formCapture ($fillable,$nullable);
	}

	/**
	* @param formdata returns array with form values
	*/
	/**
	* -----------------------------
	* Columns for custo table
	* -----------------------------
	* 
	*/
	public function custo_form_data(){
		$fillable=array(
			'dt_inicio'
			,'valor_total'
			,'status_financeiro'
			)
		;
		$nullable=array(
			'dt_fim'
			,'dt_pagamento'
			,'valor_pago'	
			)
		;
		//data to be stored (updated), in custos table

		/**
		* formCapture method converts fillable items in
		* array 'item_1' => Input::get('item_1'),
		*       'item_n' => Input::get('item_n') 
		* and if Input::get('nullable') is not empty
		* nullable item is added inside the array
		* @return array
		*
		*/
		return $this->formCapture ($fillable,$nullable);
	}

	public function validrules(){
		return array(
			'subclasse_id'		=>'required',
			'detalhe'			=>'required',
			'dt_inicio'			=>'required',
			//'dt_fim'			=>'required',
			'valor_total'				=>'required',
			'status_financeiro'	=>'required',
			//'classe_id'			=>'required',
			'subclasse_id'		=>'required'
			//
			//rules for convenio
			//
			)
		;
	}

	/**
	* -----------------------------
	* custos_caminhao
	* -----------------------------
	* All custogroupers records for choosen empresa that matches
	* with caminhao costs
	*/
	public function custos_caminhao ($empresa_id) {
		$c_grouper=Custogrouper::whereEmpresa_id($empresa_id)
		->whereFkname('caminhao')->get();

		$custoholder=array();
		$i=0;
		foreach ($c_grouper as $k => $c) {
			$custoholder[$i]=Custo::find($c->id);
			$i++;
		}
		return $custoholder;
	}


	/**
	* -----------------------------
	* custos_equipamento
	* -----------------------------
	* All custogroupers records for choosen empresa that matches
	* with equipamentodetail costs
	*/
	public function custos_equipamento ($empresa_id) {
		$c_grouper=Custogrouper::whereEmpresa_id($empresa_id)
		->whereFkname('equipamento')->get();

		$custoholder=array();
		$i=0;
		foreach ($c_grouper as $k => $c) {
			$custoholder[$i]=Custo::find($c->id);
			$i++;
		}
		return $custoholder;
	}

	/**
	* -----------------------------
	* custos_funcionario
	* -----------------------------
	* All custogroupers records for choosen empresa that matches
	* with funcionario costs
	*/
	public function custos_funcionario ($empresa_id) {
		$c_grouper=Custogrouper::whereEmpresa_id($empresa_id)
		->whereFkname('funcionario')->get();

		$custoholder=array();
		$i=0;
		foreach ($c_grouper as $k => $c) {
			$custoholder[$i]=Custo::find($c->id);
			$i++;
		}
		return $custoholder;
	}
}

class EmpresaCustoController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($empresa_id)
	{
		$d=new EmpresaCustoData;
		return $d->edata($empresa_id);
	}

	public function visible ($empresa_id) {
		$d=new EmpresaCustoData;

		$data=array(
			'header' 	=> $d->header(),
			'custo'		=> $d->edata($empresa_id),
			//'deleted'	=>array(),//$d->edatainactive($empresa_id),
			'empresa'	=>Empresa::find($empresa_id),
			'empresa_id'=>$empresa_id
			)
		;
		return View::make('tempviews.EmpresaCusto.index',$data);

	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($empresa_id)
	{
		$data=array(
			'empresa'=>Empresa::find($empresa_id),
			'empresa_id'=>$empresa_id
			)
		;
		return View::make('tempviews.EmpresaCusto.create',$data);

	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($empresa_id)
	{

		//instantiate fake user (for empresa and sessao)
		//SHOULD BE DELETED IN ORIGINAL PROJECT
		$fake=new fakeuser;
		//
		//
		$d=new EmpresaCustoData;
		//
		$custo_group_data=$d->custogrouper_form_data();
		//
		//
		$custo_detail_data=$d->custodetail_form_data();
		//
		//
		$custo_data=$d->custo_form_data();
		//
		//
		//
		$success=$custo_data;
		
		try{
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

			$e_group=new Custogrouper;
			foreach ($custo_group_data as $key => $value) {
				$e_group->$key 	=$value;
				$success['group_'.$key]=$value;
			}
			$e_group->empresa_id=$empresa_id;
			$e_group->save();
			$group_id=$e_group->id;

			$e_detail=new Custodetail;
			foreach ($custo_detail_data as $key => $value) {
				$e_detail->$key 	=$value;
				$success['detail_'.$key]=$value;
			}
			$e_detail->save();
			$detail_id=$e_detail->id;

			$e=new Custo;
			$e->custogrouper_id=$group_id;
			$e->custodetail_id=$detail_id;
			foreach ($custo_data as $key => $value) {
				$e->$key 	=$value;
			}
			//$e->empresa_id=$empresa_id;
			$e->status_custo=1;
			$e->sessao_id=$fake->sessao_id();
			//$e->dthr_cadastro=date('Y-m-d H:i:s');
			$e->save();

			$success['id']=$e->id;

			$res=$d->responsedata(
				'custo',
				true,
				'store',
				$success
				)
			;
			$code=200;
		}
		catch(Exception $e) {
			SysAdminHelper::NotifyError($e->getMessage());
			$res=$d->responsedata(
				'custo',
				false,
				'store',
				$validator->messages()
				)
			;
			$code=400;
		}
		return Response::json($res,$code);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($empresa_id,$id)
	{
		$d=new EmpresaCustoData;
		return $d->show($id);
	}

	public function showvisible($empresa_id,$id)
	{
		$d=new EmpresaCustoData;
		$data=array();
		//return View::make('tempviews.EmpresaCusto.show',$data);
		try {
			if (Custo::whereId($id)->count()==0) {
				$res=$d->responsedata(
					'custo',
					false,
					'show',
					$d->noexist
					)
				;
				$res=json_encode($res);
				throw new Exception($res);
			}

			$data=array(
				'custo'		=>$d->show($id),
				'header'	=>$d->header(),
				'empresa_id'=>$empresa_id,
				'id'		=>$id
				)
			;
			return View::make('tempviews.EmpresaCusto.show',$data);
			
		} catch (Exception $e) {
			return $e->getMessage();
		}

	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($empresa_id,$id)
	{
		$d=new EmpresaCustoData;
		$data=array();
		try {
			if (Custo::whereId($id)->count()==0) {
				$res=$d->responsedata(
					'custo',
					false,
					'edit',
					$d->noexist
					)
				;
				$res=json_encode($res);
				throw new Exception($res);
			}
			$data=array(
				'custo'		=>$d->show($id),
				'header'	=>$d->header(),
				'empresa_id'=>$empresa_id,
				'id'		=>$id
				)
			;
			return View::make('tempviews.EmpresaCusto.edit',$data);
			
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($empresa_id,$id)
	{
		//instantiate fake user (for empresa and sessao)
		//SHOULD BE DELETED IN ORIGINAL PROJECT
		$fake=new fakeuser;
		//
		//
		$d=new EmpresaCustoData;
		//
		$custo_detail_data=$d->custodetail_form_data();
		//
		$custo_data=$d->custo_form_data();
		$success=$custo_data;
		//return $success;
		try{
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

			$e=Custo::find($id);
			foreach ($custo_data as $key => $value) {
				$e->$key 	=$value;
			}
			//$e->status_custo=1;
			$e->sessao_id=$fake->sessao_id();
			//$e->dthr_cadastro=date('Y-m-d H:i:s');
			$e->save();

			$custodetail_id=$e->custodetail->id;
			$subclasse_id=$e->custodetail->subclasse_id;
			$e_detail=Custodetail::find($custodetail_id);
			foreach ($custo_detail_data as $key => $value) {
				if ($key!='subclasse_id') //skip subclasse id
				{
					$e_detail->$key 	=$value;
					$success['detail_'.$key]=$value;
				}
					
			}
			$e_detail->save();

			//

			$res=$d->responsedata(
				'custo',
				true,
				'update',
				$success
				)
			;
			$code=200;
		}
		catch(Exception $e) {
			SysAdminHelper::NotifyError($e->getMessage());
			$res=$d->responsedata(
				'custo',
				false,
				'update',
				$validator->messages()
				)
			;
			$code=400;
		}
		return Response::json($res,$code);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($empresa_id,$id)
	{
		$d=new EmpresaCustoData;
		try{
			if (Custo::whereId($id)->count()==0) {
				throw new Exception(json_encode($d->noexist));
			}
			$e=Custo::find($id);
			$e->status_custo=0;
			$e->save();

			$res=$d->responsedata(
				'custo',
				true,
				'delete',
				array('msg' => 'Resource was softdeleted')
				)
			;
			$code=200;

		}catch(Exception $e){

			SysAdminHelper::NotifyError($e->getMessage());

			$res=$d->responsedata(
				'custo',
				false,
				'delete',
				array('msg' => json_decode($e->getMessage()))
				)
			;
			$code=400;

		}

		return Response::json($res,$code);
	}

	public function reactivate($empresa_id,$id)
	{
		$d=new EmpresaCustoData;
		try{
			if (Custo::whereId($id)->count()==0) {
				throw new Exception(json_encode($d->noexist));
			}
			$e=Custo::find($id);
			$e->status_custo=1;
			$e->save();

			$res=$d->responsedata(
				'custo',
				true,
				'delete',
				array('msg' => 'Resource was restored!')
				)
			;
			$code=200;

		}catch(Exception $e){

			SysAdminHelper::NotifyError($e->getMessage());

			$res=$d->responsedata(
				'custo',
				false,
				'delete',
				array('msg' => json_decode($e->getMessage()))
				)
			;
			$code=400;

		}

		return Response::json($res,$code);
	}

	public function custocaminhao ($empresa_id) {
		$d=new EmpresaCustoData;
		return $d->custos_caminhao($empresa_id);
	}

	public function custoequipamento ($empresa_id) {
		$d=new EmpresaCustoData;
		return $d->custos_equipamento($empresa_id);
	}

	public function custofuncionario ($empresa_id) {
		$d=new EmpresaCustoData;
		return $d->custos_funcionario($empresa_id);
	}


	public function custofixed ($empresa_id) {
		$d=new EmpresaCustoData;
		$data=array();
		$i=0;
		foreach ($d->edata($empresa_id) as $key => $value) {
			if ($value['subclasse_nome']=='Fixas') {
				$data[$key]=$value;
			}
		}
		return $data;
	}

	//
	public function custovariable ($empresa_id) {
		$d=new EmpresaCustoData;
		$data=array();
		$i=0;
		foreach ($d->edata($empresa_id) as $key => $value) {
			if ($value['subclasse_nome']=='Variáveis') {
				$data[$key]=$value;
			}
		}
		return $data;
	}


}
