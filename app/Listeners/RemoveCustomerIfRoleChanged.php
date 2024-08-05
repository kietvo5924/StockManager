<?php

namespace App\Listeners;

use App\Events\UserRoleUpdated;
use App\Models\Customer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RemoveCustomerIfRoleChanged
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserRoleUpdated $event)
    {
        $user = $event->user;
        $oldRole = $event->oldRole;

        if ($oldRole === 'customer' && $user->role !== 'customer') {
            Customer::where('email', $user->email)->delete();
        }
    }
}
