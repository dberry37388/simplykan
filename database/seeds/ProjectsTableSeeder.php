<?php

use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::all()->each(function($user) {
            $user->projects()->create(make(\App\Project::class, [
                'owner_id' => $user->id
            ])->toArray());
            
            $user->setCurrentProject($user->projects()->first());
        });
    }
}
