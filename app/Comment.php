<?php

namespace App;

use App\Notifications\_Notification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class Comment extends Model
{
    public const FILTER_DATE = 'date';
    public const FILTER_RATED = 'rated';
    public const FILTER_VOTE_COUNT = 'vote_count';
    public const FILTERS = [self::FILTER_DATE, self::FILTER_RATED, self::FILTER_VOTE_COUNT];

    public const CACHE_PREFIX = 'com-';

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
            $user = Auth::user();
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
        $cacheKey = self::CACHE_PREFIX.$this->getId().__FUNCTION__;

        if(!Cache::get($cacheKey)) {
            Cache::put($cacheKey, $this->comment_votes()
                ->where(['comment_id' => $this->getId(), 'value' => CommentVote::UPVOTE])
                ->count(), 5);
        }

        return Cache::get($cacheKey);
    }

    /**
     * get number of down votes
     *
     * @return int
     */
    public function getDownVotes(): int
    {
        $cacheKey = self::CACHE_PREFIX.$this->getId().__FUNCTION__;

        if(!Cache::get($cacheKey)) {
            Cache::put($cacheKey, $this->comment_votes()
                ->where(['comment_id' => $this->getId(), 'value' => CommentVote::DOWNVOTE])
                ->count(), 5);
        }

        return Cache::get($cacheKey);
    }

    /**
     * Get comments based on filter
     *
     * @param string $filter
     * @param string $videoId
     * @return Builder
     */
    public static function getByFilter(string $filter, string $videoId): Builder
    {
        $commentOrder = 'created_at';

        if ($filter) {
            switch ($filter) {
                default:
                case self::FILTER_DATE:
                {
                    $commentOrder = 'created_at';
                    break;
                }
                case self::FILTER_RATED:
                case self::FILTER_VOTE_COUNT:
                {
                    $commentOrder = 'comment_votes_count';
                    break;
                }
            }
        }

        $comments = self::where(['video_id' => $videoId])->orderBy($commentOrder, 'DESC');

        if ($filter) {
            switch ($filter) {
                case self::FILTER_RATED:
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
                case self::FILTER_VOTE_COUNT:
                {
                    $comments = $comments->withCount('comment_votes');
                    break;
                }
            }
        }

        return $comments;
    }

    /**
     * Notify author of comment when another user liked it
     * @param CommentVote $vote
     * @param User $user
     */
    public function notifyUserOnCommentVote(CommentVote $vote, User $user): void
    {
        /** @var Comment $comment */
        $comment = $vote->comment()->first();

        if($vote->getValue() === VideoVote::UPVOTE) {
            $user->notify(
                new _Notification(
                    [
                        'desc' => $user->getName() . ' liked your comment',
                        'link' => route('video.show', ['video' => $comment->getVideoId()]) . '?get_comment=' . $comment->getId() . '#' . $comment->getId()
                    ]
                )
            );
        }
    }
}
