<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //  Adicionando 3 usuários no banco de dados
        for($index = 1; $index <= 3; $index++){
            User::create([
                'username' => "user$index",
                'email' => "yuri$index@teste.com",
                'password' => bcrypt('Abc123456'),
                'email_verified_at' => Carbon::now(),
                'active' => true
            ]);
        }
    }
}
