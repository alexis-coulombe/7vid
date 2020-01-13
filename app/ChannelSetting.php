<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChannelSetting extends Model
{
    public $timestamps = false;

    /**
     * Get user relation
     *
     * @return BelongsTo
     */
    public function channel(): BelongsTo
    {
        return $this->belongsTo(User::class, 'channel_id', 'id');
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get author id
     *
     * @return int
     */
    public function getChannelId(): int
    {
        return $this->channel_id;
    }

    /**
     * Set channel id
     *
     * @param int $channelId
     */
    public function setChannelId(int $channelId): void
    {
        $this->channel_id = $channelId;
    }

    /**
     * Get about
     *
     * @return string|null
     */
    public function getAbout(): ?string
    {
        return $this->about;
    }

    /**
     * Set about
     *
     * @param string $about
     */
    public function setAbout(string $about): void
    {
        $this->about = $about;
    }
}
