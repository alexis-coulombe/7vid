<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use phpDocumentor\Reflection\Types\Integer;
use Webpatser\Uuid\Uuid;

class Video extends Model
{
    // Using UUID instead
    public $incrementing = false;

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
        self::creating(static function ($model) {
            $model->{$model->getKeyName()} = (string)$model->generateNewId();
        });
    }

    public function generateNewId(): Uuid
    {
        try {
            /** @var Uuid $uuid */
            $uuid = Uuid::generate();
        } catch (\Exception $e) {
            var_dump($e->getMessage());
        }
        return $uuid;
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'video_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function votes(): HasMany
    {
        return $this->hasMany(VideoVote::class, 'video_id');
    }

    public function setting(): HasOne
    {
        return $this->hasOne(VideoSetting::class, 'video_id');
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getAuthorId() : int
    {
        return $this->author_id;
    }

    public function setAuthorId($authorId) : void
    {
        $this->author_id = $authorId;
    }

    public function getCategoryId() : int
    {
        return $this->category_id;
    }

    public function setCategoryId($categoryId) : void
    {
        $this->category_id = $categoryId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle($title): void
    {
        $this->title = $title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription($description) : void
    {
        $this->description = $description;
    }

    public function getExtension(): string
    {
        return $this->extension;
    }

    public function setExtension($extension) : void
    {
        $this->extension = $extension;
    }

    public function getDuration(): int
    {
        return $this->duration;
    }

    public function setDuration($duration) : void
    {
        $this->duration = $duration;
    }

    public function getFrameRate(): int
    {
        return $this->frame_rate;
    }

    public function setFrameRate($frameRate) : void
    {
        $this->frame_rate = $frameRate;
    }

    public function getMimeType(): string
    {
        return $this->mime_type;
    }

    public function setMimeType($mimeType) : void
    {
        $this->mime_type = $mimeType;
    }

    public function getLocation(): string
    {
        return $this->location;
    }

    public function setLocation($location) : void
    {
        $this->location = $location;
    }

    public function getThumbnail(): string
    {
        return $this->thumbnail;
    }

    public function setThumbnail($thumbnail) : void
    {
        $this->thumbnail = $thumbnail;
    }

    public function getViewsCount(): int
    {
        return $this->views_count;
    }

    public function setViewsCount($viewsCount) : void
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
}
