<?php

namespace App\Contracts\Repositories;

use App\DTO\SubscriptionDTO;
use App\Models\Subscription;
use App\Models\UserSubscription;
use Carbon\Carbon;

interface SubscriptionRepositoryInterface
{
    public function endSubscription(UserSubscription $userSubscription = null): int;
    public function setSubscriptionForUser(int $userId, int $subscriptionId, Carbon $untilTime): UserSubscription;
    public function createSubscription(array $attributes): Subscription;
    public function updateSubscription(Subscription $subscription, array $attributes): Subscription;
}
