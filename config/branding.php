<?php

return [
    /*
    | Path relatif ke public/ untuk logo (mis. images/logo.png).
    | Dipakai hanya jika belum ada logo di CMS (Beranda & situs → Logo situs).
    */
    'logo_path' => env('BRANDING_LOGO_PATH', ''),

    /*
    | URL atau path asset untuk latar body (opsional).
    | Default: file galeri yang dipakai sebelumnya (fallback).
    */
    'body_background' => env(
        'BRANDING_BODY_BG',
        'storage/galeri/dz2e2Wsl9gTktBClzMvSorZ8UXqmHjzyZ9tdAvHU.png'
    ),
];
