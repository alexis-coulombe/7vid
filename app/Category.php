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
use Illuminate\Support\Facades\Cache;

class Category extends Model
{
    public $timestamps = false;

    public const CACHE_PREFIX = 'cat-';

    /**
     * Get videos relation
     *
     * @return HasMany
     */
    public function videos(): ?HasMany
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
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * Set slug
     *
     * @param string $slug
     */
    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
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
        $cacheKey = self::CACHE_PREFIX . $this->getId() . __FUNCTION__;

        if (!Cache::get($cacheKey)) {
            Cache::put($cacheKey, $this->videos()->count(), 5);
        }

        return Cache::get($cacheKey);
    }

    /**
     * Get videos in this category
     *
     * @param string $order
     * @param int $limit
     * @return Collection
     */
    public function getVideos(string $order = 'created_at', int $limit = 16): Collection
    {
        return $this->videos()->whereHas(
            'setting',
            static function ($query) {
                $query->where(['private' => 0]);
            }
        )->where(['category_id' => $this->getId()])->limit($limit)->orderBy($order, 'DESC')->get();
    }
}
