<?php

namespace App\Services;

use App\Contracts\Repositories\SubscriptionRepositoryInterface;
use App\Contracts\Services\AddUserSubscriptionInterface;
use App\Models\Subscription;
use App\Models\User;
use App\Models\UserSubscription;

class UserSubscriptionService implements AddUserSubscriptionInterface
{
    private SubscriptionRepositoryInterface $subscriptionService;

    public function __construct(SubscriptionRepositoryInterface $service)
    {
        $this->subscriptionService = $service;
    }
    const SECONDS_IN_MONTH = 2592000;

    /**
     * @param User $user
     * @param Subscription $newSubscription
     * @param int $months
     * @return UserSubscription
     */
    public function activateSubscriptionForUser(User $user, Subscription $newSubscription, int $months): UserSubscription
    {
        if ($oldUserSub = $user->activeUserSubscription()->first()) {
            $addSecondsFromOldSub = $this->calculateMoneyTakingOldSubscription($oldUserSub, $newSubscription);
        }
        $untilTime = now()->addMonths($months)->addSeconds($addSecondsFromOldSub ?? 0);

        return $this->subscriptionService->setSubscriptionForUser($user->id, $newSubscription->id, $untilTime);
    }

    /**
     * @param UserSubscription $oldUserSub
     * @param Subscription $newSub
     * @return float|int
     */
    private function calculateMoneyTakingOldSubscription(UserSubscription $oldUserSub, Subscription $newSub)
    {
        $costOfOneSecondOldSub = $oldUserSub->subscription->cost / self::SECONDS_IN_MONTH;
        $balanceTimeOldSub = abs(strtotime($oldUserSub->valid_until) - strtotime(now()));
        $balanceMoneyFromOldSub = $costOfOneSecondOldSub * $balanceTimeOldSub;

        return $balanceMoneyFromOldSub / ($newSub->cost / self::SECONDS_IN_MONTH);
    }
}
