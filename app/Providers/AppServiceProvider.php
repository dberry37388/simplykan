<?php

namespace App\Providers;

use Illuminate\Auth\Events\Authenticated;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::component('components.card', 'card');
    
        $this->app['events']->listen(Authenticated::class, function ($e) {
            view()->share('currentUser', $e->user);
            
            view()->share('recentProjects', $e->user->projects()
                ->where('id', '!=', $e->user->current_project_id)
                ->orderBy('pivot_last_accessed_at', 'desc')
                ->get()
            );
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
