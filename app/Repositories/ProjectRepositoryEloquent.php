<?php

namespace CodeProject\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeProject\Repositories\ProjectRepository;
use CodeProject\Entities\Project;
use CodeProject\Validators\ProjectValidator;;

/**
 * Class ProjectRepositoryEloquent
 * @package namespace CodeProject\Repositories;
 */
class ProjectRepositoryEloquent extends BaseRepository implements ProjectRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Project::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function isOwner($projectId, $userId)
    {   
        $result = $this->findWhere(['id'=>$projectId, 'owner_id'=>$userId]);

        if(count($result)>0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
    public function hasMember($projectId, $memberId)
    {
        $project = $this->find($projectId);

        foreach ($project->members as $member) 
        {
            if($member->id == $memberId)
            {
                return TRUE;
            }
        }
    }


}
