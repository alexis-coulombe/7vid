<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Filesystem\Filesystem;
use League\Glide\Responses\LaravelResponseFactory;
use League\Glide\ServerFactory;

class ImageController extends Controller
{
    private $BASE_URL = 'app/img/';
    private $BASE_CACHE_URL = 'app/img/cache/';

    private $BASE_AVATAR_URL = 'app/avatar/';
    private $BASE_AVATAR_CACHE_URL = 'app/avatar/cache/';

    public function show(Filesystem $filesystem, $path)
    {
        $server = ServerFactory::create([
            'response' => new LaravelResponseFactory(app('request')),
            'source' => storage_path($this->BASE_URL),
            'cache' => storage_path($this->BASE_CACHE_URL),
            'cache_path_prefix' => '.cache',
            'base_url' => 'img',
        ]);

        return $server->getImageResponse($path, request()->all());
    }

    public function showAvatar(Filesystem $filesystem, $path)
    {
        $server = ServerFactory::create([
            'response' => new LaravelResponseFactory(app('request')),
            'source' => storage_path($this->BASE_AVATAR_URL),
            'cache' => storage_path($this->BASE_AVATAR_CACHE_URL),
            'cache_path_prefix' => '.cache',
            'base_url' => 'img',
        ]);

        return $server->getImageResponse($path, request()->all());
    }
}
