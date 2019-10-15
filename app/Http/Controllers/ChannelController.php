<?php
/**
 * Created by PhpStorm.
 * User: Alexi
 * Date: 2018-12-16
 * Time: 19:34
 */

namespace App\Http\Controllers;


use App\User;
use App\Video;

class ChannelController extends Controller
{

    public function index($userId)
    {
        $user = User::find($userId);
        if ($user == null) {
            $videos = [];
            return view('channel.index')->with('videos', $videos)->with('errors', ['This user does\'nt exist!']);
        }

        $videos = Video::where('author_id', '=', $userId)->paginate(5);
        if ($videos == null) {
            $videos = [];
        }
        return view('channel.index')->with('videos', $videos);
    }

}