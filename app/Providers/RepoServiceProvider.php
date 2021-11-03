<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repository\teacherrepositoryinterface;
use App\Repository\teacherrepository;

use App\Repository\studentrepositoryinterface;
use App\Repository\studentrepository;

use App\Repository\promotionrepositoryinterface;
use App\Repository\promotionrepository;

use App\Repository\feesrepositoryinterface;
use App\Repository\feesrepository;


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

        $this->app->bind(promotionrepositoryinterface::class,promotionrepository::class);

        $this->app->bind(feesrepositoryinterface::class,feesrepository::class);



     
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
