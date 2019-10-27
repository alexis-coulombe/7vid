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
}