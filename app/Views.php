<?php
/**
 * Created by PhpStorm.
 * User: Alexi
 * Date: 2018-12-22
 * Time: 22:42
 */

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Views extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'video_id',
        'author_id'
    ];

    public function video(): HasOne
    {
        return $this->hasOne(Video::class, 'id', 'video_id');
    }

    public function author(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'author_id');
    }
}
