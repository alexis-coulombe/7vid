<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Auth;

class CommentVote extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'comment_id',
        'author_id',
        'value'
    ];

    public function author(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'author_id');
    }

    public function comment(): HasOne
    {
        return $this->hasOne(Comment::class, 'id', 'comment_id');
    }

    public function getValue() : bool
    {
        return $this->value;
    }

    /**
     * Check if the logged user has voted for the video
     *
     * @param $value
     * @param $commentId
     * @return boolean
     */
    public static function hasVoted($value, $commentId) : bool
    {
        if(Auth::check()) {
            return self::where(['author_id' => Auth::user()->id, 'comment_id' => $commentId, 'value' => $value])->exists();
        }

        return false;
    }
}
