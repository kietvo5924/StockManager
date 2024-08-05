<?php

namespace App\Providers;

use App\Events\UserRoleUpdated;
use App\Listeners\RemoveCustomerIfRoleChanged;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        UserRoleUpdated::class => [
            RemoveCustomerIfRoleChanged::class,
        ],
    ];

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
