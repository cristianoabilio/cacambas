<?php


class fakeuser {
	public $user='Dario';

	public function empresa() {
		return 1;
	}

	public function sessao_id(){
		return 9;
	}
}

class standardjsonresponse {
	public function formdata( 
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
}


class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}
