<?php
/**
 * Created by PhpStorm.
 * User: Alexi
 * Date: 2018-12-18
 * Time: 14:26
 */

namespace App\Http\Controllers;


use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $comment = new Comment();
        $comment->video_id = $request->input('video_id');
        $comment->author_id = Auth::user()->id;
        $comment->body = $request->input('comment');
        $comment->save();

        return redirect('/video/' . $request->input('video_id'))->with('success', 'Your comment has been uploaded!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);

        if ($comment === null) {
            return back()->with('error', 'There was an error while trying to delete your comment!');
        }

        $comment->delete();

        return back()->with('success', 'Your comment has been removed!');
    }
}