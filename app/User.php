<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
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
        'country_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function videos(): HasMany
    {
        return $this->hasMany(Video::class, 'author_id', 'id');
    }

    public function country(): HasOne
    {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }

    public function videoVotes(): HasMany
    {
        return $this->hasMany(VideoVote::class, 'author_id');
    }

    public function commentVotes(): HasMany
    {
        return $this->hasMany(CommentVote::class, 'author_id');
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class, 'user_id', 'id');
    }

    public function subscribers(): Collection
    {
        return Subscription::where(['author_id' => $this->id])->get();
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getEmail() : string
    {
        return $this->email;
    }

    public function getPassword() : string
    {
        return $this->password;
    }

    public function getAvatar() : string
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
