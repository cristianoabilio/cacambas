<?php 


class FormDataCapturer{
	/**
	*---------------------------------------------------------
	* FormCapturer: form helper for data capture automation
	*---------------------------------------------------------
	* FormDataCapturer provides an easy way to make form 
	* data manipulation RESTful architecture very easy with
	* lesser amount of code to be typed.
	* 
	* 
	* @param fillable: array containing all required fields.
	* @param nullable: array containing data that if empty
	*        should return as empty.
	* @return an array data to be sent into a store / update action in a
	* resource restful controller.
	*/
	public function formCapture ($fillable,$nullable) {
		$form_data=array();

		foreach ($fillable as  $value) {
			$form_data[$value]=Input::get($value);
		}

		foreach ($nullable as $key => $value) {
			if (trim(Input::get($value))!='') {
				$form_data[$value]=Input::get($value);
			} else {
				$form_data[$value]=null;
			}
		}

		return $form_data;
	}

	/**
	*---------------------------------------------------------
	* modelDestroy: standard delete button
	*---------------------------------------------------------
	* FormDataCapturer provides an easy way to make form 
	* data manipulation RESTful architecture very easy with
	* lesser amount of code to be typed.
	* 
	* 
	* @param model: variable with model object.
	* @param route: string for destroy route
	* @param id: resource ID
	* @return a form as link output that triggers a destroy action
	*        on a resource controller.
	*/
	public function modelDestroy ($model,$route,$id) {
		$route=$route.'.destroy';
		return 
		Form::model($model,array('route'=>array($route,$id),'method'=>'DELETE')).
		'<input type="submit" value="Delete" class="btn btn-link">'.
		Form::close();
	}
}
