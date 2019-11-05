<?php
/**
 * Created by PhpStorm.
 * User: Alexi
 * Date: 2018-12-18
 * Time: 14:23
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function author()
    {
        return $this->belongsTo(User::class, 'id', 'author_id');
    }

    public function video()
    {
        return $this->hasOne(Video::class, 'id', 'video_id');
    }
}
