<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
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

    protected static function boot()
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

    public function generateNewId(): \Ramsey\Uuid\Uuid
    {
        try {
            /** @var \Ramsey\Uuid\Uuid $uuid */
            $uuid = Uuid::generate();
        } catch (\Exception $e) {
            var_dump($e->getMessage());
        }
        return $uuid;
    }

    public function comments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Comment::class, 'video_id');
    }

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function author(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function votes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(VideoVote::class, 'video_id');
    }

    public function setting(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(VideoSetting::class, 'video_id');
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getExtension()
    {
        return $this->extension;
    }

    public function getDuration()
    {
        return $this->duration;
    }

    public function getFrameRate()
    {
        return $this->frame_rate;
    }

    public function getMimeType()
    {
        return $this->mime_type;
    }

    public function getLocation()
    {
        return $this->location;
    }

    public function getThumbnail()
    {
        return $this->thumbnail;
    }

    public function getViewsCount()
    {
        return $this->views_count;
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
