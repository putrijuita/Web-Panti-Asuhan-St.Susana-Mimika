<?php

namespace App\Support;

class AdminPanel
{
    /**
     * URL absolut ke panel admin (subdomain atau /admin pada domain utama).
     */
    public static function url(string $path = '', array $query = []): string
    {
        $path = ltrim($path, '/');
        $domain = config('admin.domain');

        if (filled($domain)) {
            $scheme = parse_url((string) config('app.url'), PHP_URL_SCHEME) ?: 'https';
            $base = $scheme.'://'.$domain;
            $url = $path !== '' ? $base.'/'.$path : $base;
        } else {
            $url = $path !== '' ? url('admin/'.$path) : url('admin');
        }

        if ($query !== []) {
            $url .= (str_contains($url, '?') ? '&' : '?').http_build_query($query);
        }

        return $url;
    }
}
