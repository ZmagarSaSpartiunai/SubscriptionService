<?php

namespace App\Repositories;

use App\Contracts\Repositories\SubscriptionRepositoryInterface;
use App\Models\Subscription;
use App\Models\UserSubscription;

class SubscriptionRepository implements SubscriptionRepositoryInterface
{
    public function search(bool $onlyActive = true)
    {
        return Subscription::when($onlyActive, function ($query) {
            return $query->where('active', true);
        })->get();

    }

    /**
     * @param UserSubscription|null $userSubscription
     * @return int
     */
    public function endSubscription(UserSubscription $userSubscription = null): int
    {
        return UserSubscription::when($userSubscription, function ($query) use ($userSubscription) {
            return $query->find($userSubscription);
        })->whereNotNull('valid_until')->where('valid_until', '<=', now())->update(['valid_until' => null]);

    }
    /**
    * @param $userId
    * @param $subscriptionId
    * @param $untilTime
    * @return UserSubscription
     */
    public function setSubscriptionForUser($userId, $subscriptionId, $untilTime): UserSubscription
    {
        return UserSubscription::create([
            'user_id' => $userId,
            'subscription_id' => $subscriptionId,
            'valid_until' => $untilTime,
        ]);

    }

    /**
     * @param array $attributes
     * @return Subscription
     */
    public function createSubscription(array $attributes): Subscription
    {
        return Subscription::create($attributes)->fresh();
    }

    /**
     * @param Subscription $subscription
     * @param array $attributes
     * @return Subscription
     */
    public function updateSubscription(Subscription $subscription, array $attributes): Subscription
    {
        $subscription->update($attributes);

        return $subscription->refresh();
    }
}
