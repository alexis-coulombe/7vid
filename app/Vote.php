<?php
/**
 * Created by PhpStorm.
 * User: Alexi
 * Date: 2018-12-22
 * Time: 22:42
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Vote extends Model
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

    /**
     * Check if the logged user has voted for the video
     *
     * @param $videoId
     * @return boolean
     */
    public static function hasVoted($videoId)
    {
        return Vote::where([['author_id', '=', Auth::id()], ['video_id', '=', $videoId]])->exists();
    }

    /**
     * Get votes count by value for a video
     *
     * @param $value
     * @param $videoId
     * @return integer
     */
    public static function GetVotesByValue($value, $videoId)
    {
        return Vote::where([['value', '=', $value], ['video_id', '=', $videoId]])->count();
    }
}
