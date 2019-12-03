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
        'avatar',
        'country',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function videos(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Video::class, 'author_id', 'id');
    }

    public function country(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }

    public function videoVotes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(VideoVote::class, 'author_id');
    }

    public function commentVotes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CommentVote::class, 'author_id');
    }

    public function subscriptions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Subscription::class, 'user_id', 'id');
    }

    public function subscribers(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Subscription::class)->withTimestamps();
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getAvatar()
    {
        return $this->avatar;
    }

    public function isSubscribed($author_id): bool
    {
        return $this->subscriptions()->where(['author_id' => $author_id, 'user_id' => Auth::user()->id])->exists();
    }

    public function subscribe($channelId): void
    {
        $subscription = new Subscription();
        $subscription->author_id = $channelId;
        $subscription->user_id = Auth::user()->id;
        $subscription->save();
    }

    public function unsubscribe($channelId): void
    {
        $this->subscriptions()->where([['author_id', '=', $channelId], ['user_id', '=', $this->id]])->delete();
    }
}
