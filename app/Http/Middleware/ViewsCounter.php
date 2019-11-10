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
            $viewed = Views::firstOrCreate(['video_id' => $videoId], ['author_id' => Auth::id()]);

            if ($viewed->wasRecentlyCreated) {
                $video = Video::find($videoId);
                if ($video) {
                    $video->views_count += 1;
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
