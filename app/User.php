<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function videos()
    {
        return $this->hasMany(Video::class, 'author_id', 'id');
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'user_id', 'id');
    }

    public function subscribers()
    {
        return $this->belongsToMany(Subscription::class)->withTimestamps();
    }

    public function isSubscribed($author_id)
    {
        return $this->subscriptions()->where([['author_id', '=', $author_id], ['user_id', '=', $this->id]])->exists();
    }

    public function subscribe($channelId)
    {
        $subscription = new Subscription();
        $subscription->author_id = $channelId;
        $subscription->user_id = Auth::id();
        $subscription->save();
    }

    public function unsubscribe($channelId)
    {
        $this->subscriptions()->where([['author_id', '=', $channelId], ['user_id', '=', $this->id]])->delete();
    }
}
