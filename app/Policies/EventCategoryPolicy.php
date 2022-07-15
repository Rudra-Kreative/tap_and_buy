<?php

namespace App\Policies;

use App\Models\Administrator;
use App\Models\EventCategory;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class EventCategoryPolicy
{
    use HandlesAuthorization;

    public function create()
    {
        return (auth()->guard('administrator')->check()) || (auth()->user()->role == '2');
    }

    public function update($currentUser, EventCategory $eventCategory)
    {
       if(auth()->guard('administrator')->check())
       {
            return( $eventCategory->creatable_type == 'App\Models\Administrator') && ($currentUser->id == $eventCategory->creatable->id);
       }
        return $currentUser->id == $eventCategory->creatable->id;
    }

    public function delete($currentUser, EventCategory $eventCategory)
    {
       if(auth()->guard('administrator')->check())
       {
            return( $eventCategory->creatable_type == 'App\Models\Administrator') && ($currentUser->id == $eventCategory->creatable->id);
       }
        return $currentUser->id == $eventCategory->creatable->id;
    }

    public function suspend()
    {
        return auth()->guard('administrator')->check();
    }
}
