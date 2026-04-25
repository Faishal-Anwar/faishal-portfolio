<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'faishal@admin.com'],
            [
                'name' => 'Faishal Anwar',
                'password' => Hash::make('Faisal123'),
            ]
        );
    }
}
