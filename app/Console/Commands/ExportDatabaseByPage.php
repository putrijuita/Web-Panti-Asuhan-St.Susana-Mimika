<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

class ExportDatabaseByPage extends Command
{
    protected $signature = 'db:export-by-page
                            {--dir= : Subfolder under storage/app (default: database_export/Y-m-d_His)}';

    protected $description = 'Ekspor semua data database ke JSON: folder all_tables (semua tabel) + by_page (kelompok per nama halaman)';

    /**
     * Kelompok halaman publik/admin → daftar nama tabel (tanpa prefix).
     * Tabel yang sama tidak boleh diduplikasi di grup lain; sisanya hanya di all_tables.
     *
     * @var array<string, list<string>>
     */
    protected array $pageTableGroups = [
        'beranda_nav_footer_dan_situs_global' => [
            'site_contents',
        ],
        'halaman_tentang' => [
            'tentang_contents',
        ],
        'halaman_program_kegiatan' => [
            'program_page_contents',
            'kegiatan_categories',
            'kegiatans',
        ],
        'halaman_galeri' => [
            'galeri_page_contents',
            'galeri_categories',
            'galeri',
        ],
        'halaman_donasi' => [
            'donasi_page_contents',
            'donasis',
            'pengelolaan_donasi',
            'donasi_pengeluarans',
        ],
        'halaman_kunjungan' => [
            'kunjungan_page_contents',
            'kunjungans',
        ],
        'halaman_kontak' => [
            'kontak_page_contents',
            'kontak_pesan',
        ],
        'donasi_jasa' => [
            'donasi_jasas',
        ],
        'struktur_organisasi' => [
            'struktur_organisasis',
        ],
        'dokumentasi_video' => [
            'video_dokumentasis',
        ],
        'pengguna_dan_admin' => [
            'users',
            'password_reset_tokens',
            'sessions',
            'admins',
        ],
        'antrian_dan_cache_sistem' => [
            'jobs',
            'job_batches',
            'failed_jobs',
            'cache',
            'cache_locks',
        ],
    ];

    public function handle(): int
    {
        $sub = $this->option('dir') ?: ('database_export/'.now()->format('Y-m-d_His'));
        $root = storage_path('app/'.trim($sub, '/'));

        $byPageDir = $root.'/by_page';
        $allTablesDir = $root.'/all_tables';

        File::ensureDirectoryExists($byPageDir);
        File::ensureDirectoryExists($allTablesDir);

        $tables = $this->listAllTables();
        if ($tables === []) {
            $this->error('Tidak ada tabel yang ditemukan.');

            return self::FAILURE;
        }

        $this->info('Menemukan '.count($tables).' tabel. Mengekspor ke: '.$root);

        $assigned = [];

        foreach ($this->pageTableGroups as $pageSlug => $groupTables) {
            $payload = [
                'exported_at' => now()->toIso8601String(),
                'group_slug' => $pageSlug,
                'group_label' => $this->labelForSlug($pageSlug),
                'tables' => [],
            ];

            foreach ($groupTables as $table) {
                if (! in_array($table, $tables, true)) {
                    $payload['tables'][$table] = ['_note' => 'Tabel tidak ada di database (mungkin migrasi belum dijalankan).', 'rows' => []];

                    continue;
                }
                $assigned[$table] = true;
                $payload['tables'][$table] = [
                    'row_count' => DB::table($table)->count(),
                    'rows' => $this->dumpTable($table),
                ];
            }

            $file = $byPageDir.'/'.$pageSlug.'.json';
            $this->writeJson($file, $payload);
            $this->line('  by_page/'.$pageSlug.'.json');
        }

        foreach ($tables as $table) {
            $path = $allTablesDir.'/'.$table.'.json';
            $data = [
                'exported_at' => now()->toIso8601String(),
                'table' => $table,
                'row_count' => DB::table($table)->count(),
                'rows' => $this->dumpTable($table),
            ];
            $this->writeJson($path, $data);
            $this->line('  all_tables/'.$table.'.json');
        }

        $tablesNotInPageGroups = array_values(array_filter($tables, fn (string $t) => ! isset($assigned[$t])));

        $manifest = [
            'exported_at' => now()->toIso8601String(),
            'laravel' => app()->version(),
            'database_driver' => Schema::getConnection()->getDriverName(),
            'database_name' => $this->currentDatabaseName(),
            'root' => $root,
            'tables' => $tables,
            'by_page_groups' => array_keys($this->pageTableGroups),
            'tables_only_in_all_tables' => $tablesNotInPageGroups,
            'readme' => 'Folder all_tables berisi salinan penuh setiap tabel. Folder by_page mengelompokkan tabel yang relevan dengan halaman situs; tabel yang tidak termasuk grup apa pun tetap hanya ada di all_tables (lihat tables_only_in_all_tables).',
        ];
        $this->writeJson($root.'/manifest.json', $manifest);

        $readme = <<<'TXT'
Ekspor database (JSON)
======================

- manifest.json     Ringkasan tabel dan metadata export
- all_tables/        Satu file per nama tabel — SEMUA baris, tanpa filter
- by_page/           Pengelompokan menurut konteks halaman (nav/beranda, /tentang, /program, dll.)

Cara membuat ulang:
  php artisan db:export-by-page

Dengan folder kustom di bawah storage/app:
  php artisan db:export-by-page --dir=database_export/backup_saya

Catatan: file JSON tidak menyertakan berkas upload (gambar/video di storage); hanya path/kolom di database.
TXT;
        File::put($root.'/README.txt', $readme);

        $this->newLine();
        $this->info('Selesai. Total tabel: '.count($tables).' | Output: '.$root);

        return self::SUCCESS;
    }

    private function labelForSlug(string $slug): string
    {
        return str_replace('_', ' ', $slug);
    }

    private function currentDatabaseName(): ?string
    {
        try {
            return DB::getDatabaseName();
        } catch (\Throwable) {
            return null;
        }
    }

    /**
     * @return list<string>
     */
    private function listAllTables(): array
    {
        $driver = Schema::getConnection()->getDriverName();

        if ($driver === 'mysql') {
            $db = DB::getDatabaseName();

            return DB::table('information_schema.tables')
                ->where('table_schema', $db)
                ->where('table_type', 'BASE TABLE')
                ->orderBy('table_name')
                ->pluck('table_name')
                ->map(fn ($n) => (string) $n)
                ->values()
                ->all();
        }

        if ($driver === 'sqlite') {
            return collect(DB::select("SELECT name FROM sqlite_master WHERE type = 'table' AND name NOT LIKE 'sqlite_%' ORDER BY name"))
                ->pluck('name')
                ->map(fn ($n) => (string) $n)
                ->values()
                ->all();
        }

        if ($driver === 'pgsql') {
            return DB::table('pg_catalog.pg_tables')
                ->where('schemaname', 'public')
                ->orderBy('tablename')
                ->pluck('tablename')
                ->map(fn ($n) => (string) $n)
                ->values()
                ->all();
        }

        $this->error('Driver tidak didukung: '.$driver.'. Gunakan mysql, sqlite, atau pgsql.');

        return [];
    }

    /**
     * @return list<array<string, mixed>>
     */
    private function dumpTable(string $table): array
    {
        if (! Schema::hasTable($table)) {
            return [];
        }

        $pk = $this->guessPrimaryKey($table);

        $query = DB::table($table);
        if ($pk) {
            $query->orderBy($pk);
        }

        return $query->get()->map(function ($row) {
            $arr = json_decode(json_encode($row), true);

            return is_array($arr) ? $arr : [];
        })->values()->all();
    }

    private function guessPrimaryKey(string $table): ?string
    {
        if (Schema::hasColumn($table, 'id')) {
            return 'id';
        }

        return null;
    }

    /**
     * @param  array<string, mixed>  $data
     */
    private function writeJson(string $path, array $data): void
    {
        $json = json_encode(
            $data,
            JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_SUBSTITUTE
        );
        if ($json === false) {
            throw new \RuntimeException('Gagal encode JSON untuk: '.$path);
        }
        File::put($path, $json);
    }
}
