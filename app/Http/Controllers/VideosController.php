<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use App\Subscription;
use App\User;
use App\Video;
use App\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class VideosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect('/');
    }

    public function search(Request $request)
    {
        $rootController = new HomeController();
        return $rootController->index($request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('video.create')->with('categories', $categories);
    }

    public static function vote()
    {
        $value = Input::post('value');
        $videoId = Input::post('video_id');

        if (Vote::hasVoted($videoId)) {
            /** @var Vote $vq */
            $vq = Vote::where([['author_id', '=', Auth::id()], ['video_id', '=', $videoId]])->first();

            if ($vq->value != $value) {
                $vq->update(['value' => $value]);
            } else {
                $vq->delete();
            }
        } else {
            $vote = new Vote();
            $vote->video_id = $videoId;
            $vote->author_id = Auth::id();
            $vote->value = $value;
            $vote->save();
        }

        return response(200);
    }

    /**
     * Subscribe a user to another user
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function subscribe()
    {
        $authorId = Input::post('author_id');

        if (!Subscription::isSubscribed($authorId)) {
            $subscription = new Subscription();
            $subscription->author_id = $authorId;
            $subscription->user_id = Auth::id();
            $subscription->save();
        } else {
            Subscription::where([['author_id', '=', $authorId], ['user_id', '=', Auth::id()]])->delete();
        }

        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:64',
            'upload' => 'file|required',
            'image' => 'file|required',
            'description' => 'max:255'
        ], [
            'title.required' => 'A title is required for your video.',
            'upload.required' => 'You must choose your video to upload.',
            'upload.file' => 'Your uploaded file must be a video.'
        ]);

        $video = new Video;
        $video->author_id = Auth::id();

        if (trim($request->input('description')) == null) {
            $request->merge(['description' => 'No description provided']);
        }

        if ($request->hasFile('upload')) {
            $this->saveVideo($request->file('upload'), $request, $video);
        }

        if ($request->hasFile('upload')) {
            $this->savethumbnail($request->file('image'), $video);
        }

        $video->save();

        return redirect('/video/' . $video->ìd)->with('success', 'Your video as been shared.');
    }

    private function saveVideo($file, $request, &$video)
    {
        $destinationPath = 'videos';
        $extension = $file->getClientOriginalExtension();
        $filename = time() . '_' . uniqid() . '_v.' . $extension;
        $allowedExtensions = ['avi', 'flv', 'wmv', 'mov', 'mp4'];

        if (!in_array(strtolower($extension), $allowedExtensions)) {
            redirect('/video')->with('error', 'Wrong format. Must be: avi, flv, wmv, mov, mp4');
        }

        if ($file == null) {
            redirect('/video')->with('error', 'There was an error when uploading your video.');
        }

        $file->move($destinationPath, $filename);

        $video->title = $request->input('title');
        $video->description = $request->input('description');
        $video->category_id = $request->input('category');
        $video->extension = $extension;
        $video->location = $destinationPath . '/' . $filename;

        $getID3 = new \getID3();
        $file = $getID3->analyze(public_path() . '/' . $video->location);
        $video->duration = $file['playtime_seconds'];
    }

    private function savethumbnail($file, &$video)
    {
        $destinationPath = 'images';
        $extension = $file->getClientOriginalExtension();
        $filename = time() . '_' . uniqid() . '_v.' . $extension;
        $allowedExtensions = ['jpeg', 'jpg', 'bmp', 'png', 'gif'];

        if (!in_array(strtolower($extension), $allowedExtensions)) {
            redirect('/video/create')->with('error', 'Wrong format. Must be: jpeg, jpg, bmp, png, gif');
        }

        if ($file == null) {
            redirect('/video/create')->with('error', 'There was an error when uploading your image.');
        }

        $file->move($destinationPath, $filename);


        $video->thumbnail = $destinationPath . '\\' . $filename;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $video = Video::find($id);
        if ($video === null) {
            abort(404);
        }

        $comments = Comment::where('video_id', '=', $video->id)->get();
        $subscriptionCount = Subscription::where('author_id', '=', $video->author->id)->count();

        return view('video.show')
            ->with('video', $video)
            ->with('comments', $comments)
            ->with('subscriptionCount', $subscriptionCount);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }
}
