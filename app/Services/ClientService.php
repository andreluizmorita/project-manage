<?php

namespace CodeProject\Services;

use Validator;

use CodeProject\Validators\ClientValidator;
use CodeProject\Repositories\ClientRepository;

use CodeProject\Entities\Project;

class ClientService 
{
	protected $repository;
	protected $validator;

	public function __construct(ClientRepository $repository, ClientValidator $validator)
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

	public function update($data = array(), $id = NULL)
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