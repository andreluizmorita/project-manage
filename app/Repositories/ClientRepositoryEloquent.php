<?php

namespace CodeProject\Repositories;

use CodeProject\Entities\Client; 
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

class ClientRepositoryEloquent extends BaseRepository implements ClientRepository
{

	public function model()
	{
		return Client::class;
	}

	/**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}