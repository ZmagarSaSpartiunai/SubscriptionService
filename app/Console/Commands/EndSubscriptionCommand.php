<?php

namespace App\Console\Commands;

use App\Contracts\Repositories\SubscriptionRepositoryInterface;
use App\Models\UserSubscription;
use Illuminate\Console\Command;

class EndSubscriptionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscription:end';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check subscription expires.';
    private SubscriptionRepositoryInterface $repository;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(SubscriptionRepositoryInterface $repository)
    {
        $this->repository = $repository;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $result = $this->repository->endSubscription();

        $this->info($result . ' subscriptions are ended.');
    }
}
