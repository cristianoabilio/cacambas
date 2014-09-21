<?php

class CacambasController extends BaseController {

	protected $layout = 'templates.main';
	protected $section_title = 'Caçambas';
	protected $template_data = array();


	public function index()
	{
		// $cacambas = Cacamba::All();

		$this->template_data['cacambas'] = $cacambas = null;
		$this->template_data['section_title'] = $this->section_title;

		return $this->layout->content = View::make('modules.cacambas.list',$this->template_data);
	}


	public function create()
	{
		$this->template_data['action'] = 'add';
		return $this->layout->content = View::make('modules.cacambas.form',$this->template_data);
	}


	public function store()
	{

		try{

			$validator = Validator::make(
			                             Input::All(),
			                             array(
			                                   'IDEquipamentoBase' => 'required',
			                                   'IDEmpresa' => 'required',
			                                   'status' => 'required'
			                                   ),
			                             array('required' => 'Preencha o campo :attribute.')
			                             );

			if ($validator->fails())
				throw new Exception(json_encode(array('validation_errors'=>$validator->messages()->all())));


			$r = new Equipamento;

			$r->IDEquipamentoBase = Input::get('IDEquipamentoBase', null);
			$r->IDEmpresa = Input::get('IDEmpresa', null);
			$r->codigo = Input::get('codigo',null);
			$r->rfid = Input::get('rfid',null);
			$r->qrcode = Input::get('qrcode',null);
			$r->gps = Input::get('gps',null);
			$r->status = Input::get('status',1);
			$r->IDStatus = Input::get('IDStatus',0);
			$r->sessao_id = $this->id_sessao;
			$r->dthr_cadastro = date("Y-m-d H:i:s");

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
		return $this->layout->content = View::make('modules.cacambas.form',$this->template_data);
	}


	public function update()
	{

		try{

			$validator = Validator::make(
			                             Input::All(),
			                             array(
			                                   'IDEquipamento' => 'required',
			                                   'IDEquipamentoBase' => 'required',
			                                   'IDEmpresa' => 'required',
			                                   'status' => 'required'
			                                   ),
			                             array('required' => 'Preencha o campo :attribute.')
			                             );

			if ($validator->fails())
				throw new Exception(json_encode(array('validation_errors'=>$validator->messages()->all())));



			$r = Equipamento::where('IDEquipamento', '=', Input::get('IDEquipamento'))
												//->where('IDEquipamentoBase','=',Input::get('IDEquipamentoBase'))
												//->where('IDEmpresa','=',Input::get('IDEmpresa'))
												->firstOrFail();

			$r->IDEmpresa = Input::get('IDEmpresa', null);
			$r->IDEquipamentoBase = Input::get('IDEquipamentoBase',null);
			$r->codigo = Input::get('codigo',null);
			$r->rfid = Input::get('rfid',null);
			$r->qrcode = Input::get('qrcode',null);
			$r->gps = Input::get('gps',null);
			$r->status = Input::get('status',1);
			$r->IDStatus = Input::get('IDStatus',0);
			$r->sessao_id = $this->id_sessao;
			$r->save();

			$res = array('status'=>'success','msg' => 'Registro salvo com sucesso!');

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
			                             array('IDEquipamento' => 'required'),
			                             array('required' => 'Preencha o campo :attribute.')
			                             );

			if ($validator->fails())
				throw new Exception(json_encode(array('validation_errors'=>$validator->messages()->all())));

			$r = Equipamento::where('IDEquipamento', '=', Input::get('IDEquipamento'))->firstOrFail();
			$r->delete();

			$res = array('status'=>'success','msg' => 'Registro excluído com sucesso!');

		}catch(Exception $e){

			SysAdminHelper::NotifyError($e->getMessage());

			$res = array('status'=>'error','msg' => json_decode($e->getMessage()));

		}

		return Response::json($res);
	}

	public function getCacambasByStatus($status){

		try{

			$c = Equipamento::where('status', '=', $status);
			$total = $c->count();
			$cacambas = $c->get()->toArray();

			$res = array(
			             'itens' => $cacambas,
			             'total' => $total
			             );

		}catch(Exception $e){

			SysAdminHelper::NotifyError($e->getMessage());

			$res = array('status'=>'error','msg' => json_decode($e->getMessage()));

		}

		return Response::json($res);

	}

	public function setStatus(){

		try{

			$validator = Validator::make(
			                             Input::All(),
			                             array('IDEquipamento' => 'required'),
			                             array('status' => 'required'),
			                             array('required' => 'Preencha o campo :attribute.')
			                             );

			if ($validator->fails())
				throw new Exception(json_encode(array('validation_errors'=>$validator->messages()->all())));

			$res = Equipamento::where('IDEquipamento', '=', Input::get('IDEquipamento'))->firstOrFail();
			$res->status = Input::get('status');
			$res->save();


		}catch(Exception $e){

			SysAdminHelper::NotifyError($e->getMessage());

			$res = array('status'=>'error','msg' => json_decode($e->getMessage()));

		}

		return Response::json($res);
	}


	public function getCacambasByEmpresa($IDEmpresa,$IDEquipamentoBase = 'all'){

		try{

			$r = Equipamento::where('IDEmpresa', '=', $IDEmpresa);

			if($IDEquipamentoBase != 'all')
				$res = $r->where('IDEquipamentoBase','=',$IDEquipamentoBase)->get();
			else
				$res = $r->get();

		}catch(Exception $e){

			SysAdminHelper::NotifyError($e->getMessage());

			$res = array('status'=>'error','msg' => json_decode($e->getMessage()));

		}

		return Response::json($res);

	}

}