<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\SubscriptionRepositoryInterface;
use App\DTO\SubscriptionDTO;
use App\Http\Requests\StoreSubscriptionRequest;
use App\Http\Requests\UpdateSubscriptionRequest;
use App\Models\Subscription;

class SubscriptionController extends Controller
{
    private SubscriptionRepositoryInterface $subscriptionRepository;

    public function __construct(SubscriptionRepositoryInterface $repository)
    {
        $this->subscriptionRepository = $repository;
    }

    /**
     * @return mixed
     */
    public function index()
    {
        if (auth()->user()->tokenCan('admin')) {
            return $this->subscriptionRepository->search(false);
        }

        return $this->subscriptionRepository->search();
    }

    /**
     * @param StoreSubscriptionRequest $request
     * @return mixed
     */
    public function store(StoreSubscriptionRequest $request)
    {
        return $this->subscriptionRepository->createSubscription($request->input());
    }


    /**
     * @param UpdateSubscriptionRequest $request
     * @param Subscription $subscription
     * @return Subscription
     */
    public function update(UpdateSubscriptionRequest $request, Subscription $subscription)
    {
        return $this->subscriptionRepository->updateSubscription($subscription, $request->input());
    }

    /**
     * @param Subscription $subscription
     * @return bool|null
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Subscription $subscription)
    {
        $this->authorize('delete', $subscription);

        return $subscription->delete();
    }
}
