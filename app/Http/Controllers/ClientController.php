<?php

namespace CodeProject\Http\Controllers;

use Illuminate\Http\Request;

use CodeProject\Entities\Client;

use CodeProject\Repositories\ClientRepository;
use CodeProject\Services\ClientService;
use Illuminate\Support\Facades\Auth;

use CodeProject\Entities\Project;
use CodeProject\Entities\ProjectNote;

class ClientController extends Controller
{
    /**
     * @var ClientRepository
     */
    protected $repository;

    /**
     * @var ClientValidator
     */
    protected $validator;

	public function __construct(ClientRepository $repository, ClientService $service)
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

    public function update(Request $request, $id)
    {   
    	return $this->service->update($request->all(), $id);
    }

    public function show($id)
    {
    	return $this->repository->find($id);
    }

    public function destroy($id)
    {
        $projects = Project::where('client_id',$id)->get();

        foreach ($projects as $project) 
        {   
            ProjectNote::where('project_id', $project["id"])->delete();
        }

        Project::where('client_id', $id)->delete();
        
        $result = Client::where('id',$id)->delete($id);

        //return ['result'=>($result>0)?TRUE:FALSE];
    }
}
