<?php

use Illuminate\Database\Seeder;
use CodeProject\Entities\Project;

class ProjectMemberTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//\CodeProject\Entities\Client::truncate();

    	$projects = Project::all();

        foreach ($projects as $project) 
        {   
            $data = array(
                'project_id' => $project["id"],
                'member_id' => $project["user_id"],
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            );

            DB::table('project_members')->insert($data);
        }

        factory(\CodeProject\Entities\ProjectMember::class, 20)->create();
    }
}
