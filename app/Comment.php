<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
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
     * @param string $videoId
     */
    public function setVideoId(string $videoId): void
    {
        $this->video_id = $videoId;
    }

    /**
     * Get video id
     *
     * @return string
     */
    public function getVideoId(): string
    {
        return $this->video->getId();
    }

    /**
     * Check if the logged user has voted for the video
     *
     * @param bool $value
     * @param int $userId
     * @return boolean
     */
    public function userHasVoted(bool $value, int $userId = null): bool
    {
        /** @var User $user */
        $user = null;
        if ($userId === null && Auth::check()) {
            $user = Auth::user()->getId();
        } else {
            $user = User::find($userId);
        }

        if ($user === null) {
            return false;
        }

        return CommentVote::where(
            ['author_id' => $user->getId(), 'comment_id' => $this->getId(), 'value' => $value]
        )->exists();
    }

    /**
     * Get number of up votes
     *
     * @return int
     */
    public function getUpVotes(): int
    {
        return $this->comment_votes()->where(['comment_id' => $this->getId(), 'value' => CommentVote::UPVOTE])->count();
    }

    /**
     * get number of down votes
     *
     * @return int
     */
    public function getDownVotes(): int
    {
        return $this->comment_votes()->where(['comment_id' => $this->getId(), 'value' => CommentVote::DOWNVOTE])->count(
        );
    }

    /**
     * @param string $filter
     * @param string $videoId
     * @return Builder
     */
    public static function getByFilter(string $filter, string $videoId): Builder
    {
        $commentOrder = 'created_at';

        if ($filter) {
            switch ($filter) {
                case 'date':
                {
                    $commentOrder = 'created_at';
                    break;
                }
                case 'rated':
                case 'vote_count':
                {
                    $commentOrder = 'comment_votes_count';
                    break;
                }
            }
        }

        $comments = self::where(['video_id' => $videoId])->orderBy($commentOrder, 'DESC');

        if ($filter) {
            switch ($filter) {
                case 'rated':
                {
                    $comments = $comments->withCount(
                        [
                            'comment_votes',
                            'comment_votes' => static function ($query) {
                                $query->where(['value' => 1]);
                            }
                        ]
                    );

                    break;
                }
                case 'vote_count':
                {
                    $comments = $comments->withCount('comment_votes');
                    break;
                }
            }
        }

        return $comments;
    }
}
