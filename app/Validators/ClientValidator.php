<?php namespace CodeProject\Validators;

class ClientValidator
{
	public $rules = [
		'name' => 'required|max:255',
		'responsible' => 'required|max:255',
		'email' => 'required|email',
		'phone' => 'required',
		'address' => 'required',
		'obs'=>'required'
	];

	public $messages = [
    	'email.required' => 'We need to know your e-mail address!',
	];

	public $attributes = [
	    'email' => 'e-mail',
	    'obs' => 'observation',
	];
}