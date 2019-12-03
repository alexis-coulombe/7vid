<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class VideoVote extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'video_id',
        'author_id',
        'value'
    ];

    public function author(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class, 'id', 'author_id');
    }

    public function video(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Video::class, 'id', 'video_id');
    }

    public function getValue()
    {
        return $this->value;
    }

    /**
     * Check if the logged user has voted for the video
     *
     * @param $value
     * @param $videoId
     * @return boolean
     */
    public static function hasVoted($value, $videoId): ?bool
    {
        if(Auth::check()) {
            return self::where(['author_id' => Auth::user()->id, 'video_id' => $videoId, 'value' => $value])->exists();
        }

        return false;
    }
}
