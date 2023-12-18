<?php

namespace Database\Seeders;

use App\Models\Subscription;
use Faker\Factory;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Subscription::factory()
            ->count(5)
            ->state(new Sequence(
                fn($sequence) => [
                    'cost' => $sequence->index * 2.27 + $sequence->count,
                    'article_quota' => $sequence->index * $sequence->count + $sequence->count,
                ],
            ))->create();
    }
}
