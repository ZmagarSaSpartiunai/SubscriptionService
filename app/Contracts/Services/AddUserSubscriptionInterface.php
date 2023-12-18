<?php

namespace App\Contracts\Services;

use App\Models\Subscription;
use App\Models\User;
use App\Models\UserSubscription;

interface AddUserSubscriptionInterface
{
    public function activateSubscriptionForUser(User $user, Subscription $newSubscription, int $months): UserSubscription;
}
