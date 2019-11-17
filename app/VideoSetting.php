<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoSetting extends Model
{
    public $timestamps = false;

    public function video()
    {
        return $this->belongsTo(Video::class, 'video_id', 'id');
    }
}
