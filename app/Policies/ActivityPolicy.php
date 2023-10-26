<?php

namespace App\Policies;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ActivityPolicy
{

    public function update(User $user, Activity $activity): bool
    {
        return $activity->user_id == $user->id;
    }

    public function delete(User $user, Activity $activity): bool
    {
        return $activity->user_id == $user->id;
    }

}
