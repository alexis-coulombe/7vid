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

    public function channel(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    public function subscribers(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(User::class, 'id', 'user_id');
    }

    /**
     * Check if the logged user is subscribed to the other user
     *
     * @param $authorId
     * @return boolean
     */
    public function isSubscribed($authorId): bool
    {
        return $this->subscribers()->where(['author_id' => $authorId, 'user_id' => Auth::id()])->exists();
    }

    /**
     * Get subscription count for authorId
     *
     * @param $authorId
     * @return integer
     */
    public static function getSubscriptionCount($authorId): int
    {
        return self::where('author_id', '=', $authorId)->count();
    }
}
