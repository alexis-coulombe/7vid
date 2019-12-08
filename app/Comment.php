<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Comment extends Model
{
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    public function video(): HasOne
    {
        return $this->hasOne(Video::class, 'id', 'video_id');
    }

    public function votes(): HasMany
    {
        return $this->hasMany(CommentVote::class, 'comment_id');
    }

    public function getBody(): string
    {
        return $this->body;
    }
}
