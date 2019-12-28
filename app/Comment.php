<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{
    /**
     * Get user relation
     *
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    /**
     * Get video relation
     *
     * @return HasOne
     */
    public function video(): HasOne
    {
        return $this->hasOne(Video::class, 'id', 'video_id');
    }

    /**
     * Get votes relation
     *
     * @return HasMany
     */
    public function comment_votes(): HasMany
    {
        return $this->hasMany(CommentVote::class, 'comment_id');
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
     * Get body
     *
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * Set body
     *
     * @param $body
     */
    public function setBody(string $body): void
    {
        $this->body = $body;
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

    /**
     * Get author id
     *
     * @return int
     */
    public function getAuthorId(): int
    {
        return $this->author->getId();
    }

    /**
     * Set video id
     *
     * @param $body
     */
    public function setVideoId(int $videoId): void
    {
        $this->video_id = $videoId;
    }

    /**
     * Get video id
     *
     * @return int
     */
    public function getVideoId(): int
    {
        return $this->video->getId();
    }

    /**
     * Check if the logged user has voted for the video
     *
     * @param bool $value
     * @return boolean
     */
    public function userHasVoted(bool $value): bool
    {
        if (Auth::check()) {
            return CommentVote::where(['author_id' => Auth::user()->id, 'comment_id' => $this->getId(), 'value' => $value])->exists();
        }

        return false;
    }

    /**
     * Get number of up votes
     *
     * @return int
     */
    public function getUpVotes() : int
    {
        $upVotes = 0;

        foreach($this->comment_votes as $vote){
            if($vote->value){
                $upVotes++;
            }
        }

        return $upVotes;
    }

    /**
     * get number of down votes
     *
     * @return int
     */
    public function getDownVotes() : int
    {
        $downVotes = 0;

        foreach($this->comment_votes as $vote){
            if(!$vote->value){
                $downVotes++;
            }
        }

        return $downVotes;
    }
}
