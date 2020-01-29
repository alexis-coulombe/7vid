<?php

namespace App\Http\Controllers;

use App\Comment;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\RedirectResponse;
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
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        if(!Auth::check()){
            return back();
        }

        $this->validate(
            $request,
            [
                'video_id' => 'required|min:1',
                'comment' => 'required|min:1|max:255'
            ]
        );

        /** @var Comment $comment */
        $comment = new Comment();
        $comment->setVideoId($request->input('video_id'));
        $comment->setAuthorId(Auth::user()->getId());
        $comment->setBody($request->input('comment'));
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
        if (Auth::check() && request()->ajax()) {
            $value = request('value');
            $commentId = request('id');

            if (!Auth::user()->voteComment((bool)$value, $commentId)) {
                return response(403);
            }
        } else {
            return response(403);
        }

        return response(200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @return void
     */
    public function update($id): void
    {
        abort(501);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy($id): RedirectResponse
    {
        /** @var Comment $comment */
        $comment = Comment::find($id);

        if ($comment === null) {
            return back()->with('error', 'There was an error while trying to delete your comment!');
        }

        $comment->delete();

        return back()->with('success', 'Your comment has been removed!');
    }
}
