<?php

namespace CodeProject\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model implements Transformable
{	
    use TransformableTrait;
    use SoftDeletes;
    
    protected $fillable = [
    	'name',
    	'responsible',
    	'email',
    	'phone',
    	'address',
    	'obs'
    ];
}
