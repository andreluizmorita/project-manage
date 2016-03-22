<?php namespace CodeProject\Validators;

class ProjectNoteValidator
{
	public $rules = [
		'project_id' => 'required|integer',
		'title' => 'required',
		'note' => 'required'
	];

	public $messages = [
    	
	];

	public $attributes = [
	    
	];
}