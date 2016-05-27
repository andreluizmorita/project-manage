<?php

use Illuminate\Database\Seeder;

class OauthClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//\CodeProject\Entities\Project::truncate();
        $data = array(
            'id'=>'appid1',
            'secret'=>'secret',
            'name'=>'AngularApp',
            'created_at' => date('Y-m-d H:i:s', time()),
            'updated_at' => date('Y-m-d H:i:s', time())
        );

    	DB::table('oauth_clients')->insert($data);
    }
}
