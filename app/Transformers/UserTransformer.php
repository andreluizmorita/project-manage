<?php

namespace CodeProject\Transformers;

use CodeProject\Entities\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract 
{

	public function transform(User $user)
	{
		return [
			'user_id' => $user->id,
			'name' => $user->name,
			'email' => $user->email
		];
	}

}