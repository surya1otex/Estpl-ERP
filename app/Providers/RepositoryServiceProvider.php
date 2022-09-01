<?php

namespace App\Providers;

use App\Contracts\CategoryContract;
use Illuminate\Support\ServiceProvider;
use App\Repositories\CategoryRepository;
use App\Contracts\VendorContract;
use App\Repositories\VendorRepository;
use App\Contracts\ProductContract;
use App\Repositories\ProductRepository;
use App\Contracts\ClientContract;
use App\Repositories\ClientRepository;


class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    protected $repositories = [
        CategoryContract::class  => CategoryRepository::class,
        VendorContract::class    => VendorRepository::class,
        ProductContract::class   => ProductRepository::class,
        ClientContract::class    => ClientRepository::class,
    ];

    public function register()
    {
        foreach ($this->repositories as $interface => $implementation)
        {
            $this->app->bind($interface, $implementation);
        } 
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
