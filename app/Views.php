<?php
/**
 * Created by PhpStorm.
 * User: Alexi
 * Date: 2018-12-22
 * Time: 22:42
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Views extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'video_id',
        'author_id'
    ];

    public function video()
    {
        return $this->hasOne(Video::class, 'id', 'video_id');
    }

    public function author()
    {
        return $this->hasOne(User::class, 'id', 'author_id');
    }
}
