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
        $author = User::find($userId);
        if ($author == null) {
            abort(404);
        }

        return view('channel.index')->with('author', $author);
    }

}
