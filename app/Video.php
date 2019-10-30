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
        Video::creating(function ($model) {
            $model->{$model->getKeyName()} = (string)$model->generateNewId();
        });
    }

    public function generateNewId()
    {
        try {
            /** @var \Ramsey\Uuid\Uuid $uuid */
            $uuid = Uuid::generate();
        } catch (\Exception $e) {
            var_dump($e->getMessage());
        }
        return $uuid;
    }

    public function category()
    {
        return $this->hasOne('App\Category', 'id', 'category_id');
    }

    public function author()
    {
        return $this->belongsTo('App\User', 'author_id');
    }

    /**
     * Return formated views count to X,XXX,XXX
     *
     * @return string
     */
    public function getFormatedViewsCount()
    {
        return number_format($this->views_count);
    }
}
