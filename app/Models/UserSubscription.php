<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\Builder;

/**
 * @property Subscription $subscription
 */
class UserSubscription extends Model
{
    use HasFactory, Prunable;

    protected $table = 'user_subscriptions';

    protected $fillable = ['user_id', 'subscription_id', 'valid_until'];

    protected $dates = ['valid_until'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }


    protected static function booted()
    {
        static::creating(function ($userSub) {
            self::where('id', '!=', $userSub->id)->whereNotNull('valid_until')->update(['valid_until' => null]);
        });
    }
}
