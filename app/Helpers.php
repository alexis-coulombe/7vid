<?php

function time_elapsed_string($datetime, $full = false)
{
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) {
        $string = array_slice($string, 0, 1);
    }
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

function parseVideoDuration($seconds): string
{
    $hours = floor($seconds / 3600);
    $total = null;

    if ($hours > 0) {
        $total = $hours . gmdate(':i:s', $seconds % 3600);
    } else {
        $total = gmdate('i:s', $seconds % 3600);
    }

    return $total;
}

function getImage($route, $image, $params = [])
{
    $signKey = config('app.key');

    $urlBuilder = \League\Glide\Urls\UrlBuilderFactory::create($route, $signKey);
    $url = $urlBuilder->getUrl($image);

    return $url;
}

function isMobile(): bool
{
    return (new Mobile_Detect())->isMobile();
}
