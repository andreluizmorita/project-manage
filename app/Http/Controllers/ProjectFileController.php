<?php

namespace CodeProject\Http\Controllers;

use File;
use Illuminate\Http\Request;

use CodeProject\Repositories\ProjectRepository;
use CodeProject\Services\ProjectService;

use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class ProjectFileController extends Controller
{
    /**
     * @var ProjectFileRepository
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
        return $this->repository->findWhere(['owner_id'=>Authorizer::getResourceOwnerId()]);
    }

    public function store(Request $request, $projectId)
    {   
        $file = $request->file('file');

        $data = array(
            'file' => $request->file('file'),
            'extension' => $file->getClientOriginalExtension(),
            'name' => $request->name,
            'project_id' => $projectId,
            'description' => $request->description,
            'user_id' => Authorizer::getResourceOwnerId()
        );

        //dd($data);

        $storage = $this->service->createFile($data);


        return array('storage'=>$storage);

    	//return $this->service->create($request->all());
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
    	return $this->repository->with('client')->find($id);
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
