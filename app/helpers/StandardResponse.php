<?php 
class StandardResponse extends FormDataCapturer{

	//
	public function cacambasDataParam ($param) {
		$data=array();
		$i=0;
		foreach ($param as $c) {
			$c=explode(',', $c);
			$data[$i]=$c;
			$i++;
		}
		return $data;
	}

	/** 
	* function name: head.
	* @param header with headers of empresa table
	* @return array with table headers, 1 for visible
	* headers at index, 0 invisible.  At "show" method
	* all headers are visible
	*/
	public function head($data){
		$header=array();
		foreach ($this->cacambasDataParam($data) as $key => $v) {
			$header[$key]=array($v[0],$v[1]);
		}
		return $header;
	}

	/**
	* @param form_data returns array with form values
	*/
	//
	public function form_data_fixed($data){
		$data=$this->cacambasDataParam($data);
		$fillable=array();
		$nullable=array();
		foreach ($data as $k => $v) {
			if ($v[2]==0) {
				$nullable[$k]=$v[0];
			}
			else if ($v[2]==1) {
				$fillable[$k]=$v[0];
			}
		}

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



	public function valid_rules($data){
		$data=$this->cacambasDataParam($data);
		$rules=array();
		foreach ($data as $k => $v) {
			if (trim($v[3])!='') {
				$rules[$v[0] ]=$v[3];
			}
		}
		return $rules;
	}


	public function responsedata( 
		$module,
		$success,
		$action,
		$formdata ) 
	{
		if ($success) {
			$msg='success';
		} else {
			$msg='error';
		}
		return array(
			'success'=>		$success,
			'message'=>		$module.'-'.$action.'-'.$msg,
			'data' => 		$formdata
			)
		;
	}

	public function validationmssg() {
		return array(
			'required'	=> 'Check required fields'
			)
		;
	}

	public $noexist='resource does not exist';

	public function allviews(){
		return array(
			'classe',
			'subclasse',
			'compras',
			'contabancaria',
			'caminhao2',
			'cliente',
			'convenio',
			'custo',
			'empresa',
			//'empresaclienteanotacoes',
			'enderecoempresa',
			'endereco',
			'enderecobase',
			'equipamento',
			'equipamentoitem',
			'equipamentodetail',
			'fatura',
			'produtofatura',
			'produtocompra',
			'limite',
			'perfil',
			'plano',
			'produto',
			'resumoatividade',
			'resumoempresacliente',
			'resumofinanceiro',
			'funcionario',
			'bairro',
			'cidade',
			'estado',
			'sessao'
			)
		;
	}

	public function empresa_nested () {
		return array(
			//Controller => route name / subname
			'EmpresaEnderecoempresaController'	=>'enderecoempresa'
			,'EmpresaClienteController'			=>'cliente'
			,'EmpresaLoginController'			=>'login'
			,'EmpresaEquipamentoController'		=>'equipamento'
			,'EmpresaCaminhaoController'		=>'caminhao'
			,'EmpresaContabancariaController'	=>'contabancaria'
			,'EmpresaConvenioController'		=>'convenio'
			,'EmpresaCustoController'			=>'custo'
			,'EmpresaFuncionarioController'		=>'funcionario'
			,'EmpresaResumofinanceiroController'=>'resumofinanceiro'
			,'EmpresaResumoempresaclienteController'=>'resumoempresacliente'
			)
		;
		
	}

	public function empresaconvenio_nested() {
		return array(
			'EmpresaConvenioProdutofaturaController'=>'produtofatura',
			'EmpresaConvenioFaturaController'		=>'fatura'
			)
		;
	}

	public function empresaequipamento_nested() {
		return array(
			'EmpresaEquipamentoItemController'		=>'items'
			)
		;
	}

	public function empresafuncionario_nested () {
		return array(
			'EmpresaFuncionarioResumoatividadeController'	=>'resumoatividade'
			)
		;
		
	}

	public function empresacliente_nested () {
		return array(
			'EmpresaClienteAnotacoesController'	=>'anotacoes'
			)
		;
		
	}

	/*public function empresalogin_nested () {
		return array(
			'EmpresaLoginAnotacoesController'	=>'anotacoes'
			)
		;
		
	}*/

	public function classe_nested() {
		return array(
			'ClasseSubclasseController'	=>'subclasse'
			)
		;
	}

	public function estado_nested () {
		return array(
			'EstadoCidadeController'	=>'cidade'
			)
		;
	}

	public function estadocidade_nested(){
		return array(
			'EstadoCidadeBairroController'	=>'bairro'
			)
		;
	}

	public function estadocidadebairro_nested(){
		return array(
			'EstadoCidadeBairroEnderecobaseController'	=>'enderecobase'
			)
		;
	}

	public function estadocidadebairroenderecobase_nested() {
		return array(
			'EstadoCidadeBairroEnderecobaseEnderecoController'	=>'endereco'
			)
		;
	}

	public function estadocidadebairroenderecobaseendereco_nested() {
		return array(
			'EstadoCidadeBairroEnderecobaseEnderecoEnderecoempresaController'	=>'enderecoempresa'
			)
		;
	}

}
