<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $repositories = [
            'Department\DepartmentRepositoryInterface' => 'Department\DepartmentRepository',
            'User\UserRepositoryInterface' => 'User\UserRepository',
            'Role\RoleRepositoryInterface' => 'Role\RoleRepository',
        ];

        foreach ($repositories as $key => $val) {
            $this->app->bind("App\\Repositories\\$key", "App\\Repositories\\$val");
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }
}
