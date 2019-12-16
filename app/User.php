<?php

namespace App;

use App\Notifications\_Notification;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'country_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get video relation
     *
     * @return HasMany
     */
    public function videos(): HasMany
    {
        return $this->hasMany(Video::class, 'author_id', 'id');
    }

    /**
     * Get country relation
     *
     * @return HasOne
     */
    public function country(): HasOne
    {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }

    /**
     * Get setting relation
     *
     * @return HasOne
     */
    public function setting(): HasOne
    {
        return $this->hasOne(ChannelSetting::class, 'channel_id', 'id');
    }

    /**
     * Get comment relation
     *
     * @return HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'author_id', 'id');
    }

    /**
     * Get videoVotes relation
     *
     * @return HasMany
     */
    public function videoVotes(): HasMany
    {
        return $this->hasMany(VideoVote::class, 'author_id');
    }

    /**
     * Get commentVotes relation
     *
     * @return HasMany
     */
    public function commentVotes(): HasMany
    {
        return $this->hasMany(CommentVote::class, 'author_id');
    }

    /**
     * Get subscriptions relation
     *
     * @return HasMany
     */
    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class, 'user_id', 'id');
    }

    /**
     * Get subscribers relation
     *
     * @return Collection
     */
    public function subscribers(): Collection
    {
        return Subscription::where(['author_id' => $this->id])->get();
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
     * Get name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Set email
     *
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Set password
     *
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = Hash::make($password);
    }

    /**
     * Get avatar
     *
     * @return string
     */
    public function getAvatar(): string
    {
        return $this->avatar;
    }

    /**
     * Set avatar
     *
     * @param string $avatar
     */
    public function setAvatar(string $avatar): void
    {
        $this->avatar = $avatar;
    }

    /**
     * Get country id
     *
     * @return string
     */
    public function getCountryId(): string
    {
        return $this->country_id;
    }

    /**
     * Set country id
     *
     * @param int $countryId
     */
    public function setCountryId(int $countryId): void
    {
        $this->country_id = $countryId;
    }

    /**
     * Check if user is subscribed to another user
     *
     * @param $author_id
     * @return bool
     */
    public function isSubscribed($author_id): bool
    {
        return $this->subscriptions()->where(['author_id' => $author_id, 'user_id' => Auth::user()->getId()])->exists();
    }

    /**
     * Subscribe this user to another user
     *
     * @param $channelId
     */
    public function subscribe($channelId): void
    {
        $subscription = new Subscription();
        $subscription->author_id = $channelId;
        $subscription->user_id = Auth::user()->getId();
        $subscription->save();
    }

    /**
     * Unsubscribe this user from another user
     *
     * @param $channelId
     */
    public function unsubscribe($channelId): void
    {
        $this->subscriptions()->where([['author_id', '=', $channelId], ['user_id', '=', $this->getId()]])->delete();
    }

    /**
     * Get subscription count for authorId
     *
     * @param $authorId
     * @return integer
     */
    public function getSubscriptionCount(int $authorId = 0): int
    {
        if ($authorId === 0 && Auth::check()) {
            $authorId = Auth::user()->getId();
        }

        return $this->subscriptions()->where(['author_id' => $authorId])->count();
    }

    /**
     * Get subscription count for authorId
     *
     * @param $authorId
     * @return integer
     */
    public function getSubscribersCount(int $authorId = 0): int
    {
        if ($authorId === 0 && Auth::check()) {
            $authorId = Auth::user()->getId();
        }

        return Subscription::where(['author_id' => $authorId])->count();
    }
}
