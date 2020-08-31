<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        $binds = [
            [\App\Contracts\Repositories\UserRepository::class, \App\Repositories\Eloquent\UserRepositoryEloquent::class],
            [\App\Contracts\Repositories\AdminRepository::class, \App\Repositories\Eloquent\AdminRepositoryEloquent::class],
            [\App\Contracts\Repositories\PermissionRepository::class, \App\Repositories\Eloquent\PermissionRepositoryEloquent::class],
            [\App\Contracts\Repositories\RoleRepository::class, \App\Repositories\Eloquent\RoleRepositoryEloquent::class],
            [\App\Contracts\Repositories\StorageRepository::class, \App\Repositories\Eloquent\StorageRepositoryEloquent::class],
            [\App\Contracts\Repositories\HandleLogRepository::class, \App\Repositories\Eloquent\HandleLogRepositoryEloquent::class],
        ];

        foreach ($binds as $bind) $this->app->bind(...$bind);
    }
}
