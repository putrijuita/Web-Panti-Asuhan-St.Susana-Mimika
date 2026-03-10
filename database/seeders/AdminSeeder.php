<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::updateOrCreate(
            ['email' => 'nuryantijuita@gmail.com'],
            [
                'name'     => 'Nuryanti Juita',
                'password' => Hash::make('1234'),
                'role'     => 'super_admin',
            ]
        );
    }
}
