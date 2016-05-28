<?php

namespace CodeProject\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectFile extends Model implements Transformable
{
    use TransformableTrait;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'project_id',
        'name',
        'description',
    	'extension'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
