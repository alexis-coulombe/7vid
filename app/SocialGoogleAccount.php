<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialGoogleAccount extends Model
{
    protected $fillable = [
        'user_id',
        'provider_user_id',
        'provider'
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    ////https://medium.com/@confidenceiyke/laravel-5-8-google-socialite-authentication-a8b57aa59241
}
