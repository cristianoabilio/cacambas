<?php 
class StandardResponse extends FormDataCapturer{
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
			'convenio',
			'custo',
			'empresa',
			'enderecoempresa',
			'endereco',
			'enderecobase',
			'fatura',
			'produtofatura',
			'produtocompra',
			'limite',
			'plano',
			'produto',
			'resumoatividade',
			'resumoempresacliente',
			'resumofinanceiro',
			'funcionario',
			'bairro',
			'cidade',
			'estado'
			)
		;
	}

	public function empresa_nested () {
		return array(
			//Controller => route name / subname
			'EmpresaEnderecoempresaController'	=>'enderecoempresa'
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

	public function empresafuncionario_nested () {
		return array(
			'EmpresaFuncionarioResumoatividadeController'	=>'resumoatividade'
			)
		;
		
	}

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
