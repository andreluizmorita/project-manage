<?php

namespace CodeProject\Services;

use Validator;

use CodeProject\Validators\ProjectValidator;
use CodeProject\Repositories\ProjectRepository;

class ClientService 
{
	protected $repository;
	protected $validator;

	public function __construct(ProjectRepository $repository, ProjectValidator $validator)
	{
		$this->repository = $repository;
		$this->validator = $validator;
	}

	public function create (array $data)
	{	
		$v = Validator::make($data, $this->validator->rules, $this->validator->messages, $this->validator->attributes);

        if (!$v->fails()) 
        {
            return $this->repository->create($data);
        }
        else
        {	
        	return [
				'error' => true,
				'message' => $v->errors()
			];
        	
        }
	}

	public function update(array $data, $id)
	{	
		$v = Validator::make($data, $this->validator->rules, $this->validator->messages, $this->validator->attributes);

        if (!$v->fails()) 
        {
            return $this->repository->update($data, $id);
        }
        else
        {	
        	return [
				'error' => true,
				'message' => $v->errors()
			];
        }
		
	}


}