<?php

namespace App\Http\Controllers;

use App\Comment;
use App\CommentVote;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class CommentsController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'video_id' => 'required|min:1',
            'comment' => 'required|min:1|max:255'
        ]);

        $comment = new Comment();
        $comment->video_id = $request->input('video_id');
        $comment->author_id = Auth::user()->id;
        $comment->body = $request->input('comment');
        $comment->save();

        return redirect('/video/' . $request->input('video_id'))->with('success', 'Your comment has been uploaded!');
    }

    /**
     * Add vote to comment
     *
     * @return ResponseFactory|Response
     */
    public function vote()
    {
        if (request()->ajax() && Auth::check()) {
            $value = request()->input('value');

            if (is_numeric($value)) {
                $value = $value <= 0 ? 0 : $value;
                $value = $value >= 1 ? 1 : $value;
            } else {
                return response(400);
            }

            $commentId = request()->input('id');
            $comment = Comment::find($commentId);

            if ($comment) {
                $vote = CommentVote::where(['comment_id' => $comment->id, 'author_id' => Auth::user()->id])->first();

                if ($vote) {
                    if ($value !== $vote->value) {
                        $vote->value = $value;
                        $vote->save();
                    } else {
                        $vote->delete();
                    }
                } else {
                    $vote = new CommentVote();
                    $vote->comment_id = $comment->id;
                    $vote->author_id = Auth::user()->id;
                    $vote->value = $value;
                    $vote->save();
                }
            } else {
                return response(400);
            }
        } else {
            return response(405);
        }

        return response(200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
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
