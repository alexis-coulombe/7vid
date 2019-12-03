<?php
/**
 * Created by PhpStorm.
 * User: Alexi
 * Date: 2018-12-21
 * Time: 20:09
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;

    public function videos(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Video::class, 'category_id', 'id');
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getIcon()
    {
        return $this->icon;
    }

    public function getVideosCount()
    {
        return $this->videos->count();
    }

    public function getVideos($limit = 16, $order): \Illuminate\Database\Eloquent\Collection
    {
        return $this->videos()->where('category_id', '=', $this->id)->limit($limit)->orderBy($order, 'DESC')->get();
    }
}
