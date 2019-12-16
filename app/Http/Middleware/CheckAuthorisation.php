<?php

namespace App\Http\Middleware;

use App\Video;
use App\VideoSetting;
use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAuthorisation
{
    /**
     * Increase the view count on video or update the view date for history.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     * @throws Exception
     */
    public function handle($request, Closure $next)
    {
        if ($request->route('video')) {
            /** @var Video $video */
            $video = Video::find($request->route('video'));
            /** @var VideoSetting $settings */
            if ($video) {
                $settings = $video->setting;

                if ($settings->getPrivate()) {
                    if (!Auth::check() || (Auth::check() && $video->author->getId() !== Auth::user()->getId())) {
                        return redirect()->back()->withErrors('This video is marked private');
                    }
                }
            }
        }

        return $next($request);
    }
}
