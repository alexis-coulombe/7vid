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
    public $timestamps = false;

    protected $fillable = [
        'video_id',
        'author_id'
    ];
}