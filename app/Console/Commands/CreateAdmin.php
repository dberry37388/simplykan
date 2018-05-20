<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:admin {email} {first_name} {last_name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates an admin account.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $email = $this->argument('email');
        $first_name = $this->argument('first_name');
        $last_name = $this->argument('last_name');
        
        if ($this->confirm('Let system generate password for you?')) {
            $password = str_random(16);
            $this->info("Your password: $password");
        } else {
            $password = $this->secret('Please enter your new password');
        }
        
        $password = bcrypt($password);
        
        $is_admin = true;
        
        User::create(compact('email', 'password', 'first_name', 'last_name', 'is_admin'));
    }
}
