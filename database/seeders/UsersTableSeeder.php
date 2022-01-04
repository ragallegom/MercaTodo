<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class UsersTableSeeder extends Seeder
{

    public function run()
    {
        $user = User::where('email', 'rgallegomoreno@gmail.com')->first();

        if (!$user) {
            User::create([
                'name' => 'Rgallego',
                'email' => 'rgallegomoreno@gmail.com',
                'role' => 'admin',
                'password' => Hash::make('password')
            ]);
        }
    }
}
