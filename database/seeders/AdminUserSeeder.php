<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
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