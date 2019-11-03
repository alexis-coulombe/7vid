<?php
/**
 * Created by PhpStorm.
 * User: Alexi
 * Date: 2018-12-22
 * Time: 22:42
 */

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Subscription extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'author_id',
        'user_id'
    ];

    public function author(){
        return $this->hasOne('App\User', 'id', 'author_id');
    }

    /**
     * Check if the logged user is subscribed to the other user
     *
     * @param $authorId
     * @return boolean
     */
    public static function isSubscribed($authorId)
    {
        return Subscription::where([['author_id', '=', $authorId], ['user_id', '=', Auth::id()]])->exists();
    }

    /**
     * Get subscription count for authorId
     *
     * @param $author_id
     * @return integer
     */
    public static function getSubscriptionCount($authorId)
    {
        return Subscription::where('author_id', '=', $authorId)->count();
    }
}
