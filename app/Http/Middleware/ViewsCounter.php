<?php

namespace App\Http\Middleware;

use App\Video;
use App\Views;
use Closure;
use Illuminate\Support\Facades\Auth;

class ViewsCounter
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check() && $request->route('video')) {
            $videoId = $request->route('video');
            $viewed = Views::firstOrCreate(['video_id' => $videoId], ['author_id' => Auth::id()]);

            if ($viewed->wasRecentlyCreated) {
                $video = Video::find($videoId);
                $video->views_count += 1;
                $video->save();
            }
        }

        return $next($request);
    }
}
