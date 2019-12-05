<?php
/**
 * Created by PhpStorm.
 * User: Alexi
 * Date: 2018-12-21
 * Time: 20:09
 */

namespace App;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    public $timestamps = false;

    public function videos(): HasMany
    {
        return $this->hasMany(Video::class, 'category_id', 'id');
    }

    public function getTitle() : string
    {
        return $this->title;
    }

    public function getIcon() : string
    {
        return $this->icon;
    }

    public function getVideosCount() : int
    {
        return $this->videos->count();
    }

    public function getVideos($order, $limit = 16): Collection
    {
        return $this->videos()->where('category_id', '=', $this->id)->limit($limit)->orderBy($order, 'DESC')->get();
    }
}
