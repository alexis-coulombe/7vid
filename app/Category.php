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

    public function videos()
    {
        return $this->hasMany('App\Video');
    }

    public function getVideosCount()
    {
        return $this->videos->count();
    }

    public function getVideos($limit = 16, $order)
    {
        return $this->videos()->where('category_id', '=', $this->id)->limit($limit)->orderBy($order, 'ASC')->get();
    }
}
