<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repository\teacherrepositoryinterface;
use App\Repository\teacherrepository;


class RepoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(teacherrepositoryinterface::class,teacherrepository::class);

     
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
