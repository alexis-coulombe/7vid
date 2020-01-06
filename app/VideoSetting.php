<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VideoSetting extends Model
{
    public $timestamps = false;

    /**
     * Get video relation
     *
     * @return BelongsTo
     */
    public function video(): BelongsTo
    {
        return $this->belongsTo(Video::class, 'video_id', 'id');
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
     * Get video id
     *
     * @return string
     */
    public function getVideoId(): string
    {
        return $this->video_id;
    }

    /**
     * Set video id
     *
     * @param string $videoId
     */
    public function setVideoId(string $videoId): void
    {
        $this->video_id = $videoId;
    }

    /**
     * Get private
     *
     * @return bool
     */
    public function getPrivate(): bool
    {
        return $this->private;
    }

    /**
     * Set private
     *
     * @param bool $private
     */
    public function setPrivate(bool $private): void
    {
        $this->private = $private;
    }

    /**
     * Get allow comments
     *
     * @return bool
     */
    public function getAllowComments(): bool
    {
        return $this->allow_comments;
    }

    /**
     * Set allow comments
     *
     * @param bool $allow
     */
    public function setAllowComments(bool $allow): void
    {
        $this->allow_comments = $allow;
    }

    /**
     * Get allow votes
     *
     * @return bool
     */
    public function getAllowVotes(): bool
    {
        return $this->allow_votes;
    }

    /**
     * Set allow votes
     *
     * @param bool $allow
     */
    public function setAllowVotes(bool $allow): void
    {
        $this->allow_votes = $allow;
    }
}
