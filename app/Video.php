<?php

namespace App;

use App\Notifications\_Notification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Webpatser\Uuid\Uuid;

class Video extends Model
{
    // Using UUID instead
    public $incrementing = false;

    public const CACHE_PREFIX = 'vid-';

    public $fillable = [
        'category_id',
        'title',
        'description',
        'thumbnail'
    ];

    protected static function boot(): void
    {
        parent::boot();

        /**
         * Attach to the 'creating' Model Event to provide a UUID
         * for the `id` field (provided by $model->getKeyName())
         */
        self::creating(
            static function ($model) {
                $model->{$model->getKeyName()} = (string)$model->generateNewId();
            }
        );
    }

    /**
     * Generate UUID
     *
     * @return string
     */
    public function generateNewId(): string
    {
        try {
            /** @var Uuid $uuid */
            $uuid = Uuid::generate()->string;
        } catch (\Exception $e) {
            var_dump($e->getMessage());
        }
        return $uuid;
    }

    /**
     * Get comments relation
     *
     * @return HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'video_id');
    }

    /**
     * Get category relation
     *
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    /**
     * Get author relation
     *
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Get votes relation
     *
     * @return HasMany
     */
    public function votes(): HasMany
    {
        return $this->hasMany(VideoVote::class, 'video_id');
    }

    /**
     * Get setting relation
     *
     * @return HasOne
     */
    public function setting(): HasOne
    {
        return $this->hasOne(VideoSetting::class, 'video_id');
    }

    /**
     * Get id
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Get author id
     *
     * @return int
     */
    public function getAuthorId(): int
    {
        return $this->author_id;
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
     * Get category id
     *
     * @return int
     */
    public function getCategoryId(): int
    {
        return $this->category_id;
    }

    /**
     * Set category id
     *
     * @param int $categoryId
     */
    public function setCategoryId(int $categoryId): void
    {
        $this->category_id = $categoryId;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Set title
     *
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Set description
     *
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * Get extension
     *
     * @return string
     */
    public function getExtension(): string
    {
        return $this->extension;
    }

    /**
     * Set extension
     *
     * @param string $extension
     */
    public function setExtension(string $extension): void
    {
        $this->extension = $extension;
    }

    /**
     * Get duration
     *
     * @return int
     */
    public function getDuration(): int
    {
        return $this->duration;
    }

    /**
     * Set duration
     *
     * @param int $duration
     */
    public function setDuration(int $duration): void
    {
        $this->duration = $duration;
    }

    /**
     * Get frame rate
     *
     * @return int
     */
    public function getFrameRate(): int
    {
        return $this->frame_rate;
    }

    /**
     * Set frame rate
     *
     * @param int $frameRate
     */
    public function setFrameRate(int $frameRate): void
    {
        $this->frame_rate = $frameRate;
    }

    /**
     * Get mime type
     *
     * @return string
     */
    public function getMimeType(): string
    {
        return $this->mime_type;
    }

    /**
     * Set mime type
     *
     * @param string $mimeType
     */
    public function setMimeType(string $mimeType): void
    {
        $this->mime_type = $mimeType;
    }

    /**
     * Get file location
     *
     * @return string
     */
    public function getLocation(): string
    {
        return $this->location;
    }

    /**
     * Set file location
     *
     * @param string $location
     */
    public function setLocation(string $location): void
    {
        $this->location = $location;
    }

    /**
     * Get file thumbnail
     *
     * @return string
     */
    public function getThumbnail(): string
    {
        return $this->thumbnail;
    }

    /**
     * Set file thumbnail
     *
     * @param string $thumbnail
     */
    public function setThumbnail(string $thumbnail): void
    {
        $this->thumbnail = $thumbnail;
    }

    /**
     * Get view count
     *
     * @return int
     */
    public function getViewsCount(): int
    {
        return $this->views_count;
    }

    /**
     * Set view count
     *
     * @param int $viewsCount
     */
    public function setViewsCount(int $viewsCount): void
    {
        $this->views_count = $viewsCount;
    }

    /**
     * Return formated views count to X,XXX,XXX
     *
     * @return string
     */
    public function getFormatedViewsCount(): string
    {
        return number_format($this->views_count);
    }

    /**
     * Return formated title to not exceed limit
     *
     * @param int $limit
     * @return string
     */
    public function getFormatedTitle(int $limit): string
    {
        return strlen($this->getTitle()) > $limit ? substr($this->getTitle(), 0, $limit) . '...' : $this->getTitle();
    }

    /**
     * Check if the logged user has voted for the video
     *
     * @param bool $value
     * @param null $userId
     * @return boolean
     */
    public function userHasVoted(bool $value, $userId = null): bool
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

        return $this->votes()->where(['author_id' => $user->getId(), 'value' => $value])->exists();
    }

    /**
     * Get video up votes
     *
     * @return int
     */
    public function getUpVotes(): int
    {
        $cacheKey = self::CACHE_PREFIX.$this->getId().__FUNCTION__;

        if(!Cache::get($cacheKey)) {
            $upVotes = 0;

            foreach ($this->votes as $vote) {
                if ($vote->value) {
                    $upVotes++;
                }
            }

            Cache::put($cacheKey, $upVotes, 5);
        }

        return Cache::get($cacheKey);
    }

    /**
     * Get video down votes
     *
     * @return int
     */
    public function getDownVotes(): int
    {
        $cacheKey = self::CACHE_PREFIX.$this->getId().__FUNCTION__;

        if(!Cache::get($cacheKey)) {
            $downVotes = 0;

            foreach ($this->votes as $vote) {
                if (!$vote->value) {
                    $downVotes++;
                }
            }

            Cache::put($cacheKey, $downVotes, 5);
        }

        return Cache::get($cacheKey);
    }

    /**
     * Notify author of video when another user liked it
     * @param VideoVote $vote
     * @param User $user
     */
    public function notifyUserOnVideoVote(VideoVote $vote, User $user): void
    {
        /** @var Video $video */
        $video = $vote->video()->first();

        if($vote->getValue() === VideoVote::UPVOTE) {
            $user->notify(
                new _Notification(
                    [
                        'desc' => $user->getName() . ' liked your video',
                        'link' => route('video.show', ['video' => $video->getId()])
                    ]
                )
            );
        }
    }
}
