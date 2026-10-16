<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'dummy@bookboxd.com'],
            [
                'name' => 'Dummy User',
                'username' => 'Dummy',
                'foto' => null,
                'password' => '123456',
            ]
        );

        $this->call(LivroSeeder::class);
    }
}