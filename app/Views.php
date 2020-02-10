<?php

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

    /**
     * Get video relation
     *
     * @return HasOne
     */
    public function video(): ?HasOne
    {
        return $this->hasOne(Video::class, 'id', 'video_id');
    }

    /**
     * Get author relation
     *
     * @return HasOne
     */
    public function author(): ?HasOne
    {
        return $this->hasOne(User::class, 'id', 'author_id');
    }

    /**
     * Get show_in_history
     *
     * @return bool
     */
    public function getShowInHisory(): bool
    {
        return $this->show_in_history;
    }

    /**
     * Set show_in_history
     *
     * @param bool $show
     * @return bool
     */
    public function setShowInHisory(bool $show): bool
    {
        $this->show_in_history = $show;
    }
}
