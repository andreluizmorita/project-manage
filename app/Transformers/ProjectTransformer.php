<?php

namespace CodeProject\Transformers;

use CodeProject\Entities\Project;
use League\Fractal\TransformerAbstract;

class ProjectTransformer extends TransformerAbstract 
{
	protected $defaultIncludes = [
		'members',
		'client',
		'owner'
	];

	public function transform(Project $project)
	{
		return [
			'project_id' => $project->id,
			'project' => $project->name,
			'description' => $project->description,
			'progress' => $project->progress,
			'status' => $project->status,
			'due_date' => $project->due_date,
		];
	}

	public function includeMembers(Project $project)
	{
		return $this->collection($project->members, new ProjectMemberTransformer());
	}

	public function includeOwner(Project $project)
	{
		return $this->item($project->owner, new UserTransformer());
	}

	public function includeClient(Project $project)
	{	
		return $this->item($project->client, new ClientTransformer());
	}
}