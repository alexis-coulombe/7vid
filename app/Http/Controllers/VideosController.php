<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use App\CommentVote;
use App\Notifications\_Notification;
use App\Subscription;
use App\User;
use App\Video;
use App\VideoSetting;
use App\VideoVote;
use Faker\Provider\File;
use getid3_exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class VideosController extends Controller
{
    public function __construct()
    {
        $this->middleware('viewsCounter');
        $this->middleware('checkAuthorisation');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        return redirect(route('home'));
    }

    /**
     * Search for videos that fits filters
     *
     * @param Request $request
     * @return HomeController
     */
    public function search(Request $request): View
    {
        $search = request('search');

        $videos = Video::where('title', 'like', '%' . $search . '%')->orWhere('description', 'like', '% ' . $search . ' %')->paginate(20, ['*'], 'video_page');
        $authors = User::where('name', 'like', '%' . $search . '%')->paginate(12, ['*'], 'author_page');


        return view('video.search')->with('videos', $videos)
            ->with('authors', $authors);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): View
    {
        /** @var User $author */
        $author = Auth::user();
        $subscribers = $author->subscribers();

        /** @var User $subscriber */
        foreach($subscribers as $subscriber){
            $user = User::find($subscriber);
            $user->notify(new _Notification('Test'));
        }

        $categories = Category::all();

        return view('video.create')->with('categories', $categories);
    }

    /**
     * Add vote to video
     *
     * @return ResponseFactory|Response
     */
    public static function vote()
    {
        if (request()->ajax() && Auth::check()) {
            $value = request()->input('value');

            if (is_numeric($value)) {
                $value = $value <= 0 ? 0 : $value;
                $value = $value >= 1 ? 1 : $value;
            } else {
                return response(400);
            }

            $videoId = request()->input('id');
            /** @var Video $video */
            $video = Video::find($videoId);

            if ($video) {
                $vote = VideoVote::where(['video_id' => $video->getId(), 'author_id' => Auth::user()->id])->first();

                if ($vote) {
                    if ($value !== $vote->value) {
                        $vote->value = $value;
                        $vote->save();
                    } else {
                        $vote->delete();
                    }
                } else {
                    /** @var VideoVote $vote */
                    $vote = new VideoVote();
                    $vote->video_id = $video->getId();
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
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     * @throws ValidationException
     * @throws getid3_exception
     */
    public function store(Request $request): Response
    {
        $this->validateVideoInputs($request);

        /** @var Video $video */
        $video = new Video;
        $video->author_id = Auth::user()->id;

        if (strlen(request('description')) > 0 && strlen(trim(request('description'))) === 0) {
            $request->merge(['description' => 'No description provided']);
        }

        if ($request->hasFile('upload')) {
            $destinationPath = 'videos';
            $extension = request('upload')->getClientOriginalExtension();
            $allowedExtensions = ['avi', 'flv', 'mov', 'mp4'];

            if (!in_array(strtolower($extension), $allowedExtensions)) {
                return redirect('/video')->with('error', 'Wrong format. Must be: avi, flv, mov, mp4');
            }

            if (request('upload') == null) {
                return redirect('/video')->with('error', 'There was an error when uploading your video.');
            }

            $filename = time() . '_' . uniqid() . '.' . $extension;
            request('upload')->move($destinationPath, $filename);

            $video->title = request('title');
            $video->description = request('description');
            $video->category_id = request('category');
            $video->extension = $extension;
            $video->location = $destinationPath . '/' . $filename;

            $getID3 = new \getID3();
            $file = $getID3->analyze(public_path() . '/' . $video->location);
            $video->duration = $file['playtime_seconds'];
            $video->frame_rate = isset($file['frame_rate']) ? $file['frame_rate'] : 0;
            $video->mime_type = $file['mime_type'];
        }

        if ($request->hasFile('image')) {
            $destinationPath = 'images';
            $extension = request('image')->getClientOriginalExtension();
            $filename = time() . '_' . uniqid() . '.' . $extension;
            $allowedExtensions = ['jpeg', 'jpg', 'png'];

            if (!in_array(strtolower($extension), $allowedExtensions)) {
                return redirect(route('video.create'))->with('error', 'Wrong format. Must be: jpeg, jpg, png');
            }

            if (request('image') === null) {
                return redirect(route('video.create'))->with('error', 'There was an error when uploading your image.');
            }

            request('image')->move($destinationPath, $filename);

            $video->thumbnail = $destinationPath . '\\' . $filename;
        }

        $video->save();

        /** @var VideoSetting $setting */
        $setting = new VideoSetting();
        $setting->video_id = $video->id;
        $setting->private = request('private') ? 1 : 0;
        $setting->allow_comments = request('allow_comments') ? 1 : 0;
        $setting->allow_votes = request('allow_votes') ? 1 : 0;
        $setting->save();

        /** @var User $author */
        $author = $video->author;
        $subscribers = $author->subscribers;

        if(count($subscribers) > 0) {
            /** @var User $subscriber */
            foreach ($subscribers as $subscriber) {
                $subscriber->notify(new _Notification([
                    'desc' => $author->getName() . ' uploaded a video',
                    'link' => route('video.show', ['video' => $video->getId()])
                ]));
            }
        }

        return redirect(route('video.show', ['video' => $video->getId()]))->with('success', 'Your video as been shared.');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return View
     */
    public function show($id): View
    {
        /** @var Video $video */
        $video = Video::find($id);
        if ($video === null) {
            abort(404);
        }

        $comments = Comment::where('video_id', '=', $video->id)->orderBy('created_at', 'DESC')->take(5)->get();
        $subscriptionCount = Subscription::where('author_id', '=', $video->author->id)->count();

        $relatedVideos = Video::where('title', 'like', '%' . $video->getTitle() . '%')
            ->orWhere('category_id', '=', $video->category_id)->limit(10)->get();

        $upVotes = 0;
        $downVotes = 0;

        foreach ($video->votes as $vote) {
            if($vote->value) {
                $upVotes++;
            } else {
                $downVotes++;
            }
        }

        return view('video.show')
            ->with('video', $video)
            ->with('comments', $comments)
            ->with('subscriptionCount', $subscriptionCount)
            ->with('relatedVideos', $relatedVideos)
            ->with('upVotes', $upVotes)
            ->with('downVotes', $downVotes);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response | View
     */
    public function edit($id)
    {
        /** @var Video $video */
        $video = Video::find($id);

        if ($video === null) {
            abort(404);
        }

        if(Auth::user()->id !== $video->author->id){
            return redirect(route('video.show', ['video' => $video->getId()]));
        }

        return view('video.settings')->with('video', $video);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     * @throws ValidationException
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $this->validateVideoInputs($request, '', '');

        /** @var Video $video */
        $video = Video::find($id);

        if ($video === null) {
            abort(404);
        }

        if ($request->hasFile('thumbnail')) {
            $video->update($request->except(['_token', '_method']));
            $this->saveThumbnail($request->file('thumbnail'), $video);
        } else {
            $video->update($request->except(['_token', '_method', 'thumbnail']));
        }

        /** @var VideoSetting $setting */
        $setting = $video->setting;

        $setting->allow_comments = $request->input('allow_comments') ? 1 : 0;
        $setting->allow_votes = $request->input('allow_votes') ? 1 : 0;
        $setting->private = $request->input('private') ? 1 : 0;

        $video->save();
        $setting->save();

        return back()->with('video', $video);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return void
     * @throws \Exception
     */
    public function destroy($id): Request
    {
        /** @var Video $video */
        $video = Video::find($id);

        if ($video === null) {
            return back()->with('error', 'There was an error while trying to delete your video!');
        }

        if(Auth::user()->id !== $video->author->id){
            return redirect(route('video.show', ['video' => $video->getId()]));
        }

        $video->delete();

        return back();
    }

    /**
     * Check if form inputs on creating / updating a video are all valid
     *
     * @param $request
     * @param string $imageRequired
     * @param string $uploadRequired
     * @throws ValidationException
     */
    public function validateVideoInputs($request, $imageRequired = 'required', $uploadRequired = 'required'): void
    {
        $this->validate($request, [
            'title' => 'required|max:64',
            'upload' => 'file|' . $uploadRequired,
            'image' => 'file|' . $imageRequired,
            'description' => 'max:255',
            //'recaptcha' => 'required|recaptcha'
        ], [
            'title.required' => 'A title is required for your video.',
            'upload.required' => 'You must choose your video to upload.',
            'upload.file' => 'Your uploaded file must be a video.'
        ]);
    }
}
