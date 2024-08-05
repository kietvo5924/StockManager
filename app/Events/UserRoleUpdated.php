<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserRoleUpdated
{
    use Dispatchable, SerializesModels;

    public $user;
    public $oldRole;

    /**
     * Create a new event instance.
     */
    public function __construct(User $user, $oldRole)
    {
        $this->user = $user;
        $this->oldRole = $oldRole;
    }
}
