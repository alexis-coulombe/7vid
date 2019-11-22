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

    public function getId()
    {
        return $this->id;
    }

    public function getPrivate()
    {
        return $this->private;
    }

    public function getAllowComments()
    {
        return $this->allow_comments;
    }

    public function getAllowVotes()
    {
        return $this->allow_votes;
    }
}
