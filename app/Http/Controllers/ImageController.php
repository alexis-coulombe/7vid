<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Filesystem\Filesystem;
use League\Glide\Responses\LaravelResponseFactory;
use League\Glide\ServerFactory;
use League\Glide\Signatures\SignatureException;
use League\Glide\Signatures\SignatureFactory;

class ImageController extends Controller
{
    private $BASE_URL = 'app/img/';
    private $BASE_CACHE_URL = 'app/img/cache/';

    private $BASE_AVATAR_URL = 'app/avatar/';
    private $BASE_AVATAR_CACHE_URL = 'app/avatar/cache/';

    public function show(Filesystem $filesystem, $path)
    {
        try {
            $signkey = config('app.key');

            // Validate HTTP signature
            SignatureFactory::create($signkey)->validateRequest(request()->path(), $_GET);
        } catch (SignatureException $e) {
            var_dump('Wrong signature ' . $e->getMessage());
            exit(1);
        }

        $server = ServerFactory::create([
            'response' => new LaravelResponseFactory(app('request')),
            'source' => storage_path($this->BASE_URL),
            'cache' => storage_path($this->BASE_CACHE_URL),
            'cache_path_prefix' => '.cache',
            'base_url' => 'img',
            'max_image_size' => 2000*2000
        ]);

        return $server->getImageResponse($path, request()->all());
    }

    public function showAvatar(Filesystem $filesystem, $path)
    {
        try {
            $signkey = config('app.key');

            SignatureFactory::create($signkey)->validateRequest(request()->path(), $_GET);
        } catch (SignatureException $e) {
            var_dump($e->getMessage());
            exit();
        }

        $server = ServerFactory::create([
            'response' => new LaravelResponseFactory(app('request')),
            'source' => storage_path($this->BASE_AVATAR_URL),
            'cache' => storage_path($this->BASE_AVATAR_CACHE_URL),
            'cache_path_prefix' => '.cache',
            'base_url' => 'img',
            'max_image_size' => 2000*2000
        ]);

        return $server->getImageResponse($path, request()->all());
    }
}
