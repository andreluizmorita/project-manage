<?php

namespace CodeProject\Http\Controllers;

use Illuminate\Http\Request;

use CodeProject\Repositories\ProjectRepository;
use CodeProject\Services\ProjectService;

use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class ProjectController extends Controller
{
    /**
     * @var ProjectRepository
     */
    protected $repository;

    /**
     * @var ProjectValidator
     */
    protected $validator;

	public function __construct(ProjectRepository $repository, ProjectService $service)
	{
		$this->repository = $repository;
		$this->service = $service;
	}

    public function index()
    {   
        return $this->repository->findWhere(['user_id'=>Authorizer::getResourceOwnerId()]);
    }

    public function store(Request $request)
    {
    	return $this->service->create($request->all());
    }

    public function update(Request $request, $id)
    {   
        if($this->checkProjectPermissions($id)==FALSE)
        {
            return ['error'=>'Access Forbidden'];
        }

    	return $this->service->update($request->all(), $id);
    }

    public function show($id)
    {   
        if($this->checkProjectPermissions($id)==FALSE)
        {
            return ['error'=>'Access Forbidden'];
        }
    	return $this->repository->find($id);
    }

    public function destroy($id)
    {   
        if($this->checkProjectOwner($id)==FALSE)
        {
            return ['error'=>'Access Forbidden'];
        }

    	return $this->repository->delete($id);
    }

    private function checkProjectOwner($projectId)
    {
        $userId = Authorizer::getResourceOwnerId();

        return $this->repository->isOwner($projectId, $userId);
    }

    private function checkProjectMember($projectId)
    {
        $userId = Authorizer::getResourceOwnerId();

        return $this->repository->hasMember($projectId, $userId);
    }

    private function checkProjectPermissions($projectId)
    {
        return $this->checkProjectOwner($projectId) && $this->checkProjectMember($projectId);
    }
}
