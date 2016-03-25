<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//\CodeProject\Entities\Client::truncate();

        factory(\CodeProject\Entities\User::class)->create([
            'name' => 'Andre',
            'email' => 'andreluizmorita@gmail.com',
            'password' => bcrypt('teste1234'),
            'remember_token' => str_random(10),
        ]);
    	factory(\CodeProject\Entities\User::class, 20)->create();
    }
}
