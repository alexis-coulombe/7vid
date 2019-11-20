<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CommentVote extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'comment_id',
        'author_id',
        'value'
    ];

    public function author()
    {
        return $this->hasOne(User::class, 'id', 'author_id');
    }

    public function comment()
    {
        return $this->hasOne(Comment::class, 'id', 'comment_id');
    }

    /**
     * Check if the logged user has voted for the video
     *
     * @param $value
     * @param $commentId
     * @return boolean
     */
    public static function hasVoted($value, $commentId)
    {
        if(Auth::check()) {
            return CommentVote::where(['author_id' => Auth::user()->id, 'comment_id' => $commentId, 'value' => $value])->exists();
        } else {
            return false;
        }
    }
}
