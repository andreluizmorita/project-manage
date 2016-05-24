<?php

namespace CodeProject\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Project extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
    	'project_id',
    	'user_id'
    ];

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_members', 'member_id', 'project_id');
    }
}
