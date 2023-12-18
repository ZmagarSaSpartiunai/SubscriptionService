<?php

namespace App\Http\Controllers;

use App\Contracts\Services\AddUserSubscriptionInterface;
use App\Models\Subscription;
use App\Models\User;
use App\Models\UserSubscription;
use Illuminate\Http\Request;

class UserSubscriptionController extends Controller
{
    private AddUserSubscriptionInterface $userSubscriptionService;

    public function __construct(AddUserSubscriptionInterface $service)
    {
        $this->userSubscriptionService = $service;
    }

    /**
     * @param Request $request
     * @param User $user
     * @param Subscription $subscription
     * @return UserSubscription
     */
    public function confirmPayment(Request $request, Subscription $subscription): UserSubscription
    {
        return $this->userSubscriptionService->activateSubscriptionForUser($request->user(), $subscription, $request->months);
    }
}
