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

    public const UPVOTE = true;
    public const DOWNVOTE = false;

    /**
     * Get user relation
     *
     * @return HasOne
     */
    public function author(): ?HasOne
    {
        return $this->hasOne(User::class, 'id', 'author_id');
    }

    /**
     * Get comment relation
     *
     * @return HasOne
     */
    public function comment(): ?HasOne
    {
        return $this->hasOne(Comment::class, 'id', 'comment_id');
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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

    /**
     * Set comment id
     *
     * @param int $commentId
     */
    public function setCommentId(int $commentId): void
    {
        $this->comment_id = $commentId;
    }

    /**
     * Set author id
     *
     * @param int $authorId
     */
    public function setAuthorId(int $authorId): void
    {
        $this->author_id = $authorId;
    }
}
