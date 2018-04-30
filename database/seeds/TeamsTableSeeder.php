<?php

use Illuminate\Database\Seeder;

class TeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws \Exception
     */
    public function run()
    {
        $owner = \App\User::first();

        $currentTeam = factory(\App\Team::class)->create([
            'owner_id' => $owner->id,
            'name' => 'Acme, Inc.'
        ]);

        $additionalTeam = factory(\App\Team::class)->create([
            'owner_id' => $owner->id,
            'name' => 'Doppelganger, LLC.',
            'parent_id' => $currentTeam->id,
        ]);

        // set the owners current team id.
        $owner->joinTeam($currentTeam);
        $owner->joinTeam($additionalTeam);
    }
}
