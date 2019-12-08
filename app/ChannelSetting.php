<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChannelSetting extends Model
{
    public $timestamps = false;

    public function channel(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getAuthorId(): int
    {
        return $this->author_id;
    }

    public function getAbout(): string
    {
        return $this->about;
    }
}
