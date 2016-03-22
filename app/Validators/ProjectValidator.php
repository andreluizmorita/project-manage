<?php namespace CodeProject\Validators;

class ProjectValidator
{
	public $rules = [
		'owner_id' => 'required|integer',
		'client_id' => 'required|integer',
		'name' => 'required',
		'progresss' => 'required',
		'status' => 'required',
		'due_date' => 'required'
	];

	public $messages = [
    	'email.required' => 'We need to know your e-mail address!',
	];

	public $attributes = [
	    'due_date' => 'data de entrega'
	];
}