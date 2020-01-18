<?php

namespace App;

use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'country_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get video relation
     *
     * @return HasMany
     */
    public function videos(): HasMany
    {
        return $this->hasMany(Video::class, 'author_id', 'id');
    }

    /**
     * Get country relation
     *
     * @return HasOne
     */
    public function country(): HasOne
    {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }

    /**
     * Get setting relation
     *
     * @return HasOne
     */
    public function setting(): HasOne
    {
        return $this->hasOne(ChannelSetting::class, 'channel_id', 'id');
    }

    /**
     * Get comment relation
     *
     * @return HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'author_id', 'id');
    }

    /**
     * Get videoVotes relation
     *
     * @return HasMany
     */
    public function videoVotes(): HasMany
    {
        return $this->hasMany(VideoVote::class, 'author_id');
    }

    /**
     * Get commentVotes relation
     *
     * @return HasMany
     */
    public function commentVotes(): HasMany
    {
        return $this->hasMany(CommentVote::class, 'author_id');
    }

    /**
     * Get subscriptions relation
     *
     * @return HasMany
     */
    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class, 'user_id', 'id');
    }

    /**
     * Get subscribers relation
     *
     * @return Collection
     */
    public function subscribers(): Collection
    {
        return Subscription::where(['author_id' => $this->id])->get();
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
     * Get name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Set email
     *
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Set password
     *
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = Hash::make($password);
    }

    /**
     * Get avatar
     *
     * @return string
     */
    public function getAvatar(): string
    {
        return $this->avatar;
    }

    /**
     * Set avatar
     *
     * @param string $avatar
     */
    public function setAvatar(string $avatar): void
    {
        $this->avatar = $avatar;
    }

    /**
     * Get country id
     *
     * @return string
     */
    public function getCountryId(): string
    {
        return $this->country_id;
    }

    /**
     * Set country id
     *
     * @param int $countryId
     */
    public function setCountryId(int $countryId): void
    {
        $this->country_id = $countryId;
    }

    /**
     * Check if user is subscribed to another user
     *
     * @param $author_id
     * @return bool
     */
    public function isSubscribed($author_id): bool
    {
        if (Auth::check()) {
            return $this->subscriptions()->where(
                [
                    'author_id' => $author_id,
                    'user_id' => Auth::user()->getId()
                ]
            )->exists();
        }

        return false;
    }

    /**
     * Subscribe this user to another user
     *
     * @param $channelId
     */
    public function subscribe($channelId): void
    {
        if (Auth::check()) {
            if ($this->isSubscribed($channelId)) {
                $this->unsubscribe($channelId);
            } else {
                /** @var Subscription $subscription */
                $subscription = new Subscription();
                $subscription->setAuthorId($channelId);
                $subscription->setUserId(Auth::user()->getId());
                $subscription->save();
            }
        }
    }

    /**
     * Unsubscribe this user from another user
     *
     * @param $channelId
     */
    public function unsubscribe($channelId): void
    {
        if (Auth::check()) {
            $this->subscriptions()->where(
                [
                    ['author_id', '=', $channelId],
                    ['user_id', '=', Auth::user()->getId()]
                ]
            )->delete();
        }
    }

    /**
     * Get subscription count for authorId
     *
     * @param $authorId
     * @return integer
     */
    public function getSubscriptionCount(int $authorId = null): int
    {
        /** @var User $user */
        $user = null;
        if (!$user = $this->validateUser($authorId)) {
            return 0;
        }

        return $this->subscriptions()->where(['author_id' => $user->getId()])->count();
    }

    /**
     * Get subscription count for authorId
     *
     * @param $authorId
     * @return integer
     */
    public function getSubscribersCount(int $authorId = null): int
    {
        /** @var User $user */
        $user = null;
        if (!$user = $this->validateUser($authorId)) {
            return 0;
        }

        return Subscription::where(['author_id' => $user->getId()])->count();
    }

    /**
     * Set user vote for video
     *
     * @param bool $value
     * @param string $videoId
     * @param int $userId
     * @return bool
     * @throws Exception
     */
    public function voteVideo(bool $value, string $videoId, int $userId = null): bool
    {
        /** @var User $user */
        $user = null;
        if (!$user = $this->validateUser($userId)) {
            return false;
        }

        /** @var Video $video */
        $video = null;
        if (!$video = $this->validateVideo($videoId)) {
            return false;
        }

        /** @var VideoVote $vote */
        $vote = VideoVote::where(['video_id' => $video->getId(), 'author_id' => $user->getId()])->first();

        if ($vote) {
            if ($value !== $vote->getValue()) {
                $vote->setValue($value);
                $vote->save();
            } else {
                $vote->delete();
            }
        } else {
            /** @var VideoVote $vote */
            $vote = new VideoVote();
            $vote->setVideoId($video->getId());
            $vote->setAuthorId($user->getId());
            $vote->setValue($value);
            $vote->save();
        }

        return true;
    }

    /**
     * Set user vote for comment
     *
     * @param bool $value
     * @param int $commentId
     * @param int $userId
     * @return bool
     * @throws Exception
     */
    public function voteComment(bool $value, int $commentId, int $userId = null): bool
    {
        /** @var User $user */
        $user = null;

        if (!$user = $this->validateUser($userId)) {
            return false;
        }

        /** @var Comment $comment */
        $comment = null;
        if (!$comment = $this->validateComment($commentId)) {
            return false;
        }

        /** @var CommentVote $vote */
        $vote = CommentVote::where(['comment_id' => $comment->getId(), 'author_id' => $user->getId()])->first();

        if ($vote) {
            if ($value !== $vote->getValue()) {
                $vote->setValue($value);
                $vote->save();
            } else {
                $vote->delete();
            }
        } else {
            /** @var CommentVote $vote */
            $vote = new CommentVote();
            $vote->setCommentId($comment->getId());
            $vote->setAuthorId($user->getId());
            $vote->setValue($value);
            $vote->save();
        }

        return true;
    }

    /**
     * Check if user exists, logged or not then return it.
     *
     * @param $userId
     * @return \Illuminate\Contracts\Auth\Authenticatable|bool
     */
    private function validateUser($userId)
    {
        if ($userId && self::find($userId)) {
            $user = self::find($userId);
        } elseif (Auth::check()) {
            $user = Auth::user();
        } else {
            return false;
        }

        return $user;
    }

    /**
     * Check if video exists, then return it.
     *
     * @param $commentId
     * @return bool|Comment
     */
    private function validateComment($commentId)
    {
        if (Comment::find($commentId)) {
            $comment = Comment::find($commentId);
        } else {
            return false;
        }

        return $comment;
    }

    /**
     * Check if video exists, then return it.
     *
     * @param $videoId
     * @return bool|Video
     */
    private function validateVideo($videoId)
    {
        if (Video::find($videoId)) {
            $video = Video::find($videoId);
        } else {
            return false;
        }

        return $video;
    }
}
