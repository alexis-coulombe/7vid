<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use phpDocumentor\Reflection\Types\Integer;

class VideoSetting extends Model
{
    public $timestamps = false;

    public function video(): BelongsTo
    {
        return $this->belongsTo(Video::class, 'video_id', 'id');
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function getVideoId() : int
    {
        return $this->video_id;
    }

    public function getPrivate() : bool
    {
        return $this->private;
    }

    public function getAllowComments() : bool
    {
        return $this->allow_comments;
    }

    public function getAllowVotes() : bool
    {
        return $this->allow_votes;
    }
}
