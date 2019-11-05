<?php

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
