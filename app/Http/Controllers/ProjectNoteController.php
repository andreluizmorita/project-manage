<?php

namespace CodeProject\Http\Controllers;

use Illuminate\Http\Request;

use CodeProject\Repositories\ProjectNoteRepository;
use CodeProject\Services\ProjectNoteService;

class ProjectNoteController extends Controller
{
    /**
     * @var ProjectNoteRepository
     */
    protected $repository;

    /**
     * @var ProjectValidator
     */
    protected $validator;

	public function __construct(ProjectNoteRepository $repository, ProjectNoteService $service)
	{
		$this->repository = $repository;
		$this->service = $service;
	}

    public function index()
    {
    	return $this->repository->all();
    }

    public function store(Request $request)
    {
    	return $this->service->create($request->all());
    }

    public function update(Request $request)
    {
    	return $this->service->update($request->all());
    }

    public function show($id)
    {
    	return $this->repository->find($id);
    }

    public function destroy($id)
    {
    	return $this->repository->delete($id);
    }
}
