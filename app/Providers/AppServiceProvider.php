<?php

namespace App\Providers;

use App\Models\DonasiJasa;
use App\Models\DonasiPageContent;
use App\Models\KontakPageContent;
use App\Models\GaleriPageContent;
use App\Models\KunjunganPageContent;
use App\Models\ProgramPageContent;
use App\Models\SiteContent;
use App\Models\TentangContent;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Route::bind('jasa', fn ($value) => DonasiJasa::findOrFail($value));

        // Child @section dirender sebelum layout: suntik variabel ke view halaman tersebut.
        View::composer(['layouts.app', 'home'], function ($view) {
            $view->with('siteContent', SiteContent::resolved());
        });

        View::composer('pages.program', function ($view) {
            $view->with('programPage', ProgramPageContent::resolvedForPublic());
        });

        View::composer('pages.galeri', function ($view) {
            $view->with('galeriPage', GaleriPageContent::resolvedForPublic());
        });

        View::composer(['kunjungan.create', 'kunjungan.terima-kasih'], function ($view) {
            $view->with('kunjunganPage', KunjunganPageContent::resolvedForPublic());
        });

        View::composer('donasi.index', function ($view) {
            $view->with('donasiPage', DonasiPageContent::resolvedForPublic());
        });

        View::composer('pages.kontak', function ($view) {
            $view->with('kontakPage', KontakPageContent::resolvedForPublic());
        });

        View::composer('pages.tentang', function ($view) {
            $view->with('tentangContent', TentangContent::resolvedForPublic());
        });
    }
}
