<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Cat',
            'email' => 'cat@email.com',
            'phone_number' => '01712345678',
            'gender' => 'Female',
            'birth_date' => '1990-01-01',
            'password' => bcrypt('cat1234'),
        ]);

    }
}
