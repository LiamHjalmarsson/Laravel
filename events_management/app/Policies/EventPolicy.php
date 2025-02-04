<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User;
use Illuminate\Auth\Access\Response;


// auth serviceprovider 
class EventPolicy
{
    /**
     * Determine whether the user can view any models.
     */

     // in some actions guest will be allowerd access and for does cases you cant type hint hose with the user model 
     // have to make it optional or nullable ? 
    public function viewAny(?User $user): bool
    {
        // allows every one to have acces and use and visit 
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, Event $event): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // only authorized users can create no ? 
        // guest wont have access to create 
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Event $event): bool
    {
        // compare the user ID with the event user Id 
        return $user->id === $event->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Event $event): bool
    {
        return $user->id === $event->user_id;

    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Event $event): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Event $event): bool
    {
        //
    }
}
