<?php

class CaminhoesController extends BaseController {

	protected $layout = 'templates.main';
	protected $section_title = 'Caminhões';
	protected $template_data = array();


	public function index()
	{
		$caminhoes = Caminhao::All();

		$this->template_data['caminhoes'] = $caminhoes;
		$this->template_data['section_title'] = $this->section_title;

		return $this->layout->content = View::make('modules.caminhoes.list',$this->template_data);
	}


	public function create()
	{
		$this->template_data['action'] = 'add';
		return $this->layout->content = View::make('modules.caminhoes.form',$this->template_data);
	}


	public function store()
	{

		try{

			$validator = Validator::make(
			                             Input::All(),
			                             array(
			                                   'marca' => 'required',
			                                   'modelo' => 'required',
			                                   'placa' => 'required'
			                                   ),
			                             array(
			                                   'required' => 'Preencha o campo :attribute.',
			                                   )
			                             );

			if ($validator->fails())
				throw new Exception(json_encode(array('validation_errors'=>$validator->messages()->all())));


			$r = new Caminhao;
			$r->placa = Input::get('placa');
			$r->renavan = Input::get('renavan','nenhum');
			$r->marca = Input::get('marca');
			$r->modelo = Input::get('modelo');
			$r->apelido = Input::get('marca').' '.Input::get('modelo');
			$r->dthr_cadastro = date('Y-m-d H:i:s');
			$r->sessao_id = $this->id_sessao;
			$r->status = Input::get('status',1);
			$r->save();

			$res = array('status'=>'success','msg' => 'Registro salvo com sucesso!');

		}catch(Exception $e){

			SysAdminHelper::NotifyError($e->getMessage());

			$res = array('status'=>'error','msg' => json_decode($e->getMessage()));

		}


		return Response::json($res);

	}



	public function edit($id)
	{
		$this->template_data['action']='update';
		return $this->layout->content = View::make('modules.caminhoes.form',$this->template_data);
	}


	public function update()
	{
		try{

			$validator = Validator::make(
			                             Input::All(),
			                             array(
			                                   'marca' => 'required',
			                                   'modelo' => 'required',
			                                   'placa' => 'required',
			                                   'id' => 'required'
			                                   ),
			                             array(
			                                   'required' => 'Preencha o campo :attribute.',
			                                   )
			                             );

			if ($validator->fails())
				throw new Exception(json_encode(array('validation_errors'=>$validator->messages()->all())));

			$r = Caminhao::findOrFail(Input::get('id'));

			$r->placa = Input::get('placa');
			$r->renavan = Input::get('renavan');
			$r->marca = Input::get('marca');
			$r->modelo = Input::get('modelo');
			$r->apelido = Input::get('marca').' '.Input::get('modelo');
			$r->dthr_cadastro = date('Y-m-d H:i:s');
			$r->sessao_id = $this->id_sessao;
			$r->status = Input::get('status',1);

			$r->save();

			$res = array('status'=>'success','msg' => 'Registro atualizado com sucesso!');

		}catch(Exception $e){

			SysAdminHelper::NotifyError($e->getMessage());

			$res = array('status'=>'error','msg' => json_decode($e->getMessage()));

		}

		return Response::json($res);
	}


	public function destroy()
	{
		try{
			$validator = Validator::make(
			                             Input::All(),
			                             array('id' => 'required'),
			                             array('required' => 'Preencha o campo :attribute.')
			                             );

			if ($validator->fails())
				throw new Exception(json_encode(array('validation_errors'=>$validator->messages()->all())));

			$r = Caminhao::findOrFail(Input::get('id'));
			$r->delete();

			$res = array('status'=>'success','msg' => 'Registro excluído com sucesso!');

		}catch(Exception $e){

			SysAdminHelper::NotifyError($e->getMessage());

			$res = array('status'=>'error','msg' => json_decode($e->getMessage()));

		}

		return Response::json($res);
	}

}
