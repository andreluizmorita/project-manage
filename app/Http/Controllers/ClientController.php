<?php

namespace CodeProject\Http\Controllers;

use Illuminate\Http\Request;

use CodeProject\Entities\Client;

use CodeProject\Repositories\ClientRepository;
use CodeProject\Services\ClientService;
use Illuminate\Support\Facades\Auth;

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
    	//AuthController->verify('andreluizmorita@gmail.com','teste1234');

        $username = 'andreluizmorita@gmail.com';
        $password = 'teste1234';

        $use = Auth::validate(['email'=>$username,'password'=>$password]);

        //$use = \CodeProject\Entities\User::where('email', 'andreluizmorita@gmail.com')->first();

        dd($use);

        //return $this->repository->all();
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
    	return $this->repository->delete($id);
    }
}
