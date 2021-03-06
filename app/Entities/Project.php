<?php

namespace CodeProject\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model implements Transformable
{
    use TransformableTrait;
    use SoftDeletes;

    protected $fillable = [
    	'owner_id',
    	'client_id',
    	'name',
    	'description',
    	'progress',
    	'status',
    	'due_date'
    ];

    public function notes()
    {
        return $this->hasMany(ProjectNote::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class,'owner_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class,'client_id');
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'project_members', 'project_id', 'member_id');
    }

    public function files()
    {
        return $this->hasMany(ProjectFile::class);
    }
}
