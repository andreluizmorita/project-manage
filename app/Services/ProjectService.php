<?php

namespace CodeProject\Services;

use Validator;

use CodeProject\Validators\ProjectValidator;
use CodeProject\Repositories\ProjectRepository;

use Illuminate\Contracts\Filesystem\Factory as Storage;
use Illuminate\Filesystem\Filesystem;

class ProjectService 
{
	protected $repository;
	protected $validator;
	protected $filesystem;
	protected $storage;

	public function __construct(ProjectRepository $repository, ProjectValidator $validator, Filesystem $filesystem, Storage $storage)
	{
		$this->repository = $repository;
		$this->validator = $validator;
		$this->filesystem = $filesystem;
		$this->storage = $storage;
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

	public function createFile(array $data)
	{	
		$project = $this->repository->skipPresenter()->find($data['project_id']);
		$projectFile = $project->files()->create($data);


		$storage = $this->storage
			->disk('local')
			->put($projectFile->id.'.'.$data['extension'], $this->filesystem->get($data['file']));
		
		return $storage;
	}

}