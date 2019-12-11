<?php
/**
 * Created by PhpStorm.
 * User: Alexi
 * Date: 2018-12-21
 * Time: 20:09
 */

namespace App;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    public $timestamps = false;

    /**
     * Get videos relation
     *
     * @return HasMany
     */
    public function videos(): HasMany
    {
        return $this->hasMany(Video::class, 'category_id', 'id');
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
     * Get title
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Set title
     *
     * @param string $title
     */
    public function setTitle(string$title): void
    {
        $this->title = $title;
    }

    /**
     * Get icon
     *
     * @return string
     */
    public function getIcon(): string
    {
        return $this->icon;
    }

    /**
     * Set icon
     *
     * @param string $icon
     */
    public function setIcon(string $icon): void
    {
        $this->icon = $icon;
    }

    /**
     * Get number of videos in this category
     *
     * @return int
     */
    public function getVideosCount(): int
    {
        return $this->videos->count();
    }

    /**
     * Get videos in this category
     *
     * @param string $order
     * @param int $limit
     * @return Collection
     */
    public function getVideos(string $order, int $limit = 16): Collection
    {
        return $this->videos()->where(['category_id' => $this->getId()])->limit($limit)->orderBy($order, 'DESC')->get();
    }
}
