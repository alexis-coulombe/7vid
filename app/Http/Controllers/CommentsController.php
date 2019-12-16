<?php

namespace App\Http\Controllers;

use App\Comment;
use App\CommentVote;
use App\User;
use App\Video;
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
        $this->validate($request, [
            'video_id' => 'required|min:1',
            'comment' => 'required|min:1|max:255'
        ]);

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
        if (request()->ajax() && Auth::check()) {
            $value = request('value');

            if (is_numeric($value)) {
                $value = $value <= 0 ? 0 : $value;
                $value = $value >= 1 ? 1 : $value;
            } else {
                return response(400);
            }

            $commentId = request('id');
            /** @var Comment $comment */
            $comment = Comment::find($commentId);

            if ($comment) {
                /** @var CommentVote $vote */
                $vote = CommentVote::where(['comment_id' => $comment->getId(), 'author_id' => Auth::user()->getId()])->first();

                if ($vote) {
                    if ($value !== $vote->getValue()) {
                        $vote->setValue($value);
                        $vote->save();
                    } else {
                        $vote->delete();
                    }
                } else {
                    $vote = new CommentVote();
                    $vote->setCommentId($comment->getId());
                    $vote->setAuthorId(Auth::user()->getId());
                    $vote->setValue($value);
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
    public function update(Request $request, $id): ?Response
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $comment = Comment::find($id);

        if ($comment === null) {
            return back()->with('error', 'There was an error while trying to delete your comment!');
        }

        $comment->delete();

        return back()->with('success', 'Your comment has been removed!');
    }
}
