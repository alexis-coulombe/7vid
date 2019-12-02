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

    public function author()
    {
        return $this->hasOne(User::class, 'id', 'author_id');
    }

    public function video()
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
    public static function hasVoted($value, $videoId)
    {
        if(Auth::check()) {
            return VideoVote::where(['author_id' => Auth::user()->id, 'video_id' => $videoId, 'value' => $value])->exists();
        } else {
            return false;
        }
    }
}
