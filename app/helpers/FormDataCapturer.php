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
}