<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class AdminLoginPageContent extends Model
{
    protected $table = 'admin_login_page_contents';

    protected $fillable = [
        'page_title',
        'hero_badge_text',
        'hero_badge_icon',
        'hero_title_prefix',
        'hero_title_emphasis',
        'hero_description',
        'hero_image',
        'use_site_body_background',
        'form_title',
        'form_subtitle',
        'email_label',
        'email_placeholder',
        'password_label',
        'password_placeholder',
        'remember_label',
        'forgot_password_label',
        'forgot_password_url',
        'submit_text',
        'footer_link_text',
        'cms_note_admin',
        'cms_note_super_admin',
    ];

    protected function casts(): array
    {
        return [
            'use_site_body_background' => 'boolean',
        ];
    }

    public static function defaults(): array
    {
        return [
            'page_title' => 'Login Admin — Panti Asuhan Santa Susana',
            'hero_badge_text' => 'Area terbatas',
            'hero_badge_icon' => 'fas fa-shield-halved',
            'hero_title_prefix' => 'Panti Asuhan',
            'hero_title_emphasis' => 'Santa Susana',
            'hero_description' => 'Panel admin untuk mengelola konten, donasi, kunjungan, dan layanan panti dengan aman.',
            'hero_image' => null,
            'use_site_body_background' => true,
            'form_title' => 'Masuk ke dashboard',
            'form_subtitle' => 'Gunakan email dan kata sandi akun admin Anda.',
            'email_label' => 'Email',
            'email_placeholder' => 'nama@email.com',
            'password_label' => 'Kata sandi',
            'password_placeholder' => '••••••••',
            'remember_label' => 'Ingat saya di perangkat ini',
            'forgot_password_label' => 'Lupa kata sandi?',
            'forgot_password_url' => 'forgot-password',
            'submit_text' => 'Masuk',
            'footer_link_text' => 'Kembali ke situs publik',
            'cms_note_admin' => 'Akun dengan peran Admin dapat mengelola konten, donasi, kunjungan, dan data operasional sesuai hak akses yang diberikan.',
            'cms_note_super_admin' => 'Akun Super Admin menggunakan halaman login yang sama, tetapi memiliki akses tambahan (misalnya manajemen akun admin dan pengaturan sensitif).',
        ];
    }

    public static function singleton(): self
    {
        return static::firstOrCreate(['id' => 1], static::defaults());
    }

    public static function resolvedForLogin(): object
    {
        $defaults = static::defaults();

        if (! Schema::hasTable('admin_login_page_contents')) {
            return (object) $defaults;
        }

        $row = static::query()->find(1);
        if (! $row) {
            return (object) $defaults;
        }

        foreach ($defaults as $key => $value) {
            if ($key === 'use_site_body_background') {
                continue;
            }
            if (blank($row->{$key}) && $value !== null) {
                $row->{$key} = $value;
            }
        }

        return $row;
    }

    public static function forgotPasswordUrl(object $login): string
    {
        $raw = trim((string) ($login->forgot_password_url ?? ''));
        if ($raw === '') {
            return route('admin.password.request');
        }

        if (filter_var($raw, FILTER_VALIDATE_URL)) {
            return $raw;
        }

        $path = ltrim($raw, '/');
        if (request()->getHost() === config('admin.domain')) {
            return url('/'.$path);
        }

        return url('admin/'.$path);
    }

    public static function heroBackgroundUrl(object $login): ?string
    {
        if (! empty($login->use_site_body_background)) {
            $siteUrl = SiteContent::bodyBackgroundUrl();

            return $siteUrl !== '' ? $siteUrl : null;
        }

        $path = $login->hero_image ?? null;
        if (blank($path)) {
            return null;
        }

        if (filter_var($path, FILTER_VALIDATE_URL)) {
            return $path;
        }

        return asset('storage/'.ltrim($path, '/'));
    }

    public function fillMissingFromDefaults(): void
    {
        $defaults = static::defaults();
        $changed = false;
        foreach ($this->getFillable() as $key) {
            if (! array_key_exists($key, $defaults)) {
                continue;
            }
            if ($key === 'use_site_body_background') {
                continue;
            }
            if (blank($this->{$key}) && $defaults[$key] !== null) {
                $this->{$key} = $defaults[$key];
                $changed = true;
            }
        }
        if ($changed) {
            $this->saveQuietly();
        }
    }
}
