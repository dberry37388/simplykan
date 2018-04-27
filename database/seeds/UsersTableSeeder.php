<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class)->create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'johndoe@example.org'
        ]);

        factory(\App\User::class)->create([
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'email' => 'janedoe@example.org'
        ]);
    }
}
