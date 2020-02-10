<?php

/**
 * Get time elapsed from now and datetime
 * @param $datetime
 * @param bool $full
 * @return string
 * @throws Exception
 */
function time_elapsed_string($datetime, $full = false)
{
    $now = new DateTime;
    try {
        $ago = new DateTime($datetime);
    } catch (Exception $e) {
        echo $e->getMessage();
        exit(1);
    }
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

/**
 * Parse seconds to HH:MM:SS
 * @param $seconds
 * @return string
 */
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
    return $urlBuilder->getUrl($image, $params);
}

/**
 * Check if current user_agent is mobile
 * @return bool
 */
function isMobile(): bool
{
    return (new Mobile_Detect())->isMobile();
}

/**
 * Get master branch hash code
 * @return string
 */
function getVersion(): string
{
    if ($hash = file_get_contents(sprintf(public_path() . '/../.git/refs/heads/%s', 'master'))) {
        if (strlen($hash) > 5) {
            $hash = substr($hash, 0, 5);
        }

        return trim($hash);
    }

    return 'Invalid version';
}
