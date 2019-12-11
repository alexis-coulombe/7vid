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

    /**
     * Get user relation
     *
     * @return HasOne
     */
    public function author(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'author_id');
    }

    /**
     * Get comment relation
     *
     * @return HasOne
     */
    public function comment(): HasOne
    {
        return $this->hasOne(Comment::class, 'id', 'comment_id');
    }

    /**
     * Get value
     *
     * @return bool
     */
    public function getValue(): bool
    {
        return $this->value;
    }

    /**
     * Set value
     *
     * @param bool $value
     */
    public function setValue(bool $value): void
    {
        $this->value = $value;
    }
}
