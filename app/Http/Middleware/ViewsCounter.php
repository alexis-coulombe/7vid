<?php

namespace App\Http\Middleware;

use App\Video;
use App\Views;
use Cassandra\Date;
use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ViewsCounter
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
        if (Auth::check() && $request->route('video')) {
            $videoId = $request->route('video');
            /** @var Views $viewed */
            $viewed = Views::firstOrCreate(['video_id' => $videoId], ['author_id' => Auth::user()->getId()]);

            if ($viewed->wasRecentlyCreated) {
                /** @var Video $video */
                $video = Video::find($videoId);
                if ($video) {
                    $video->setViewsCount($video->getViewsCount() + 1);
                    $video->save();
                }
            } else {
                $viewed->updated_at = new \DateTime();
                $viewed->save();
            }
        }

        return $next($request);
    }
}
