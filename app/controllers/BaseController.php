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
