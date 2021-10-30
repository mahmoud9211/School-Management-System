<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repository\teacherrepositoryinterface;
use App\Repository\teacherrepository;

use App\Repository\studentrepositoryinterface;
use App\Repository\studentrepository;


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

        $this->app->bind(studentrepositoryinterface::class,studentrepository::class);


     
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
