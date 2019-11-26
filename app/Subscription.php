<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Subscription extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'author_id',
        'user_id'
    ];

    public function channel()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    public function subscribers()
    {
        return $this->hasMany(User::class, 'id', 'user_id');
    }

    public function getChannelId()
    {
        return $this->channel()->getId();
    }

    /**
     * Check if the logged user is subscribed to the other user
     *
     * @param $authorId
     * @return boolean
     */
    public function isSubscribed($authorId)
    {
        return $this->subscribers()->where(['author_id' => $authorId, 'user_id' => Auth::id()])->exists();
    }

    /**
     * Get subscription count for authorId
     *
     * @param $authorId
     * @return integer
     */
    public static function getSubscriptionCount($authorId)
    {
        return Subscription::where('author_id', '=', $authorId)->count();
    }
}
