<?php

if (! function_exists('formatDuration')) {
    /**
     * Format duration.
     *
     * @param float $seconds
     *
     * @return string
     */
    function formatDuration(float $seconds)
    {
        if ($seconds < 0.001) {
            return round($seconds * 1000000).'μs';
        } elseif ($seconds < 1) {
            return round($seconds * 1000, 2).'ms';
        }

        return round($seconds, 2).'s';
    }
}

if (! function_exists('http_or_https')) {
    function http_or_https($url)
    {
        if (mb_strpos($url, 'http://') === 0 || mb_strpos($url, 'https://') === 0) return true;

        return false;
    }
}
